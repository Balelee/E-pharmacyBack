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
    try {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        $message = $twilio->messages->create($user->phone, [
            'from' => env('TWILIO_PHONE_NUMBER'),
            'body' => "Votre code OTP est : $otp",
        ]);
        if (!$message->sid) {
            return response()->json(['message' => 'Erreur lors de l\'envoi du SMS.'], 500);
        }
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Erreur Twilio : ' . $e->getMessage()
        ], 500);
    }
    return response()->json([
        'infos' => [
            'message' => 'OTP envoyé sur : ' . $user->phone . '. Veuillez vérifier votre téléphone.',
            'phone' => $user->phone
        ]
    ]);
}


   public function verifyOtp(Request $request)
{
    $request->validate([
        'otp_code' => ['required', 'string', 'digits:6'],
    ]);
   $user = User::where('phone', $request->phone)
    ->where('otp_code', $request->otp_code)
   ->first();
    if (!$user) {
        return response()->json(['message' => 'Utilisateur non authentifié'], 401);
    }
    if (now()->greaterThan($user->otp_expires_at)) {
        return response()->json(['message' => 'OTP expiré.'], 401);
    }

    $user->tokens()->delete();
    $token = $user->createToken('my-app-token')->plainTextToken;
    $user->token = $token;

    return new UserResource($user);
}


 public function logoutUser(Request $request) // DECONNEXION DU USER
    {
        $request->user()->currentAccessToken()->delete();
        return new UserResource($request);

    }


  public function storeUser(Request $request)
{
    $request->validate([
        'phone' => ['required', 'numeric', 'unique:users,phone'],
        'password' => User::getValidationRule('password'),
    ]);

        $otp = rand(100000, 999999);
        $user = User::create([
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);
        try {
            $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
            $message = $twilio->messages->create($user->phone, [
                'from' => env('TWILIO_PHONE_NUMBER'),
                'body' => "Votre code OTP est : $otp",
            ]);
            if (!$message->sid) {
                return response()->json(['message' => 'Erreur lors de l\'envoi du SMS.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur Twilio : ' . $e->getMessage()
            ], 500);
        }
        return response()->json([
            'infos' => [
                'message' => 'OTP envoyé sur : ' . $user->phone . '. Veuillez vérifier votre téléphone.',
                'phone' => $user->phone
        ]
    ]);
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

//     public function redirectToGoogle()
//     {
//          return Socialite::driver('google')
//          ->with(['prompt' => 'select_account'])
//         ->stateless()
//         ->redirect();
//     }

//     public function handleGoogleCallback()
//     {
//         try {
//             $googleUser = Socialite::driver('google')->stateless()->user();
//             $user = User::where('email', $googleUser->getEmail())->first();
//             if (!$user) {
//                 $user = User::create([
//                 'google_id' => $googleUser->getId(),
//                 'userName' => $googleUser->getName(),
//                 'email' => $googleUser->getEmail(),
//             ]);
//             }
//             $user->tokens()->delete();
//             $token = $user->createToken('my-app-token')->plainTextToken;
//             $user->token = $token;

//             return new UserResource($user);
//         } catch (\Exception $e) {
//             return response()->json(['error' => 'Authentification Google échouée', 'message' => $e->getMessage()], 500);
//         }
//     }
// }
}
