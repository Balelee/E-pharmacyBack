<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public function getUsers() // Function de recuperation des users
    {
        $users = User::all();

        return UserResource::collection($users);
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'numeric', 'min:8'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::where('phone', $request->phone)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Numéro ou mot de passe incorrect.'], 401);
        }
        $otp = rand(100000, 999999);
        $user->update([
            'otp_code' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
        ]);
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        $twilio->messages->create($user->phone, [
            'from' => env('TWILIO_PHONE_NUMBER'),
            'body' => "Votre code OTP est : $otp",
        ]);

        return response()->json([
            'message' => 'OTP envoyé. Veuillez vérifier votre téléphone.',
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_code' => ['required', 'numeric', 'digits:6'],
        ]);

        $user = User::where('otp_code', $request->otp_code)->first();

        if (! $user) {
            return response()->json(['message' => 'OTP introuvable'], 404);
        }
        if (now()->greaterThan($user->otp_expires_at)) {
            return response()->json(['message' => 'OTP expiré.'], 401);
        }
        $user->update([
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);
        $user->tokens()->delete();
        $token = $user->createToken('my-app-token')->plainTextToken;
        $user->token = $token;

        return new UserResource($user);
    }

    public function storeUser(User $user, Request $request)
    {
        $request->validate([
            'userName' => User::getValidationRule('userName'),
            'lastName' => User::getValidationRule('lastName'),
            'firstName' => User::getValidationRule('firstName'),
            'birthDate' => User::getValidationRule('birthDate'),
            'birthPlace' => User::getValidationRule('birthPlace'),
            'email' => User::getValidationRule('email'),
            'password' => User::getValidationRule('password'),
        ]);

        $user = User::create([
            'userName' => $request->userName,
            'lastName' => $request->lastName,
            'firstName' => $request->firstName,
            'phone' => $request->phone,
            'birthDate' => $request->birthDate,
            'birthPlace' => $request->birthPlace,
            'email' => $request->email,
            'userType' => $request->userType,
            'password' => $request->password,
        ]);

        return new UserResource($user);
    }

    public function updateUser(User $user, Request $request)
    {
        $request->validate([
            'userName' => User::getValidationRule('userName'),
            'lastName' => User::getValidationRule('lastName'),
            'firstName' => User::getValidationRule('firstName'),
            'birthDate' => User::getValidationRule('birthDate'),
            'birthPlace' => User::getValidationRule('birthPlace'),
            'email' => User::getValidationRule('email'),
            'password' => User::getValidationRule('password'),
        ]);

        $user->update([
            'userName' => $request->userName,
            'lastName' => $request->lastName,
            'firstName' => $request->firstName,
            'phone' => $request->phone,
            'birthDate' => $request->birthDate,
            'birthPlace' => $request->birthPlace,

        ]);

        return new UserResource($user->refresh());
    }

    public function findUser(User $user)
    {
        return new UserResource($user->refresh());
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        return new UserResource($user);
    }

    public function redirectToGoogle()
    {
         return Socialite::driver('google')
         ->with(['prompt' => 'select_account'])
        ->stateless()
        ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->getEmail())->first();
            if (!$user) {
                $user = User::create([
                'google_id' => $googleUser->getId(),
                'userName' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
            ]);
            }
            $user->tokens()->delete();
            $token = $user->createToken('my-app-token')->plainTextToken;
            $user->token = $token;

            return new UserResource($user);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Authentification Google échouée', 'message' => $e->getMessage()], 500);
        }
    }
}
