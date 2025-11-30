<?php

namespace App\Http\Controllers;

use App\Events\UserLoggedIn;
use App\Http\Resources\UserResource;
use App\Models\Enums\ModelStatus;
use App\Models\Pharmacy;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // get all users for admin
    public function getUsers()
    {
        $users = User::notAdmin()->get();

        return UserResource::collection($users);
    }

    public function updateUserByAdmin(Request $request, User $user)
    {
        // Validation
        $request->validate([
            'type' => ['required', 'in:admin,pharmacien,client'],
            'status' => ['required', 'in:actif,inactif'],
            'pharmacy_id' => ['nullable', 'exists:pharmacies,id'],
        ]);

        // Mise à jour des infos
        $user->update([
            'type' => $request->type,
            'status' => $request->status,
        ]);

        if (is_null($request->pharmacy_id)) {

            Pharmacy::where('pharmacien_id', $user->id)
                ->update(['pharmacien_id' => null]);
        } else {
            $pharmacy = Pharmacy::find($request->pharmacy_id);

            if ($pharmacy) {

                Pharmacy::where('pharmacien_id', $user->id)
                    ->where('id', '!=', $pharmacy->id)
                    ->update(['pharmacien_id' => null]);
                $pharmacy->update(['pharmacien_id' => $user->id]);
            }
        }

        return new UserResource($user->load('pharmacie'));
    }

    public function loginUser(Request $request) // CONNEXION DU USER
    {
        $request->validate([
            'phone' => ['required_without:email', 'string', 'max:30'],
            'email' => ['required_without:phone', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = User::with('pharmacie')->where('email', $request->email)->orWhere('phone', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Les informations saisies sont invalides.',
            ], 404);
        }

        if ($user->status == ModelStatus::INACTIF) {
            return response([
                'message' => 'Votre compte n\'est pas encore activé. Veillez reéssayer plus tard ! ',
            ], 404);
        }
        // $user->tokens()->delete();
        if ($user->tokens()->exists()) {
            $userAgent = $request->header('User-Agent');
            $ip = $request->ip();
            event(new UserLoggedIn($user, $userAgent, $ip));
            return response([
                'message' => 'Un utilisateur est déjà connecté à ce compte. Attendez sa confirmation et réessayez plus tard !',
            ], 404);
        }
        $token = $user->createToken('my-app-token')->plainTextToken;
        $user->token = $token;
        return new UserResource($user);
    }

    public function logoutUser(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return new UserResource($user);
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'userName' => User::getValidationRule('userName'),
            'lastName' => User::getValidationRule('lastName'),
            'firstName' => User::getValidationRule('firstName'),
            'birthDate' => User::getValidationRule('birthDate'),
            'birthPlace' => User::getValidationRule('birthPlace'),
            'email' => User::getValidationRule('email'),
            'phone' => User::getValidationRule('phone'),
            'password' => User::getValidationRule('password'),
        ], User::messages());

        $user = User::create([
            'userName' => $request->userName,
            'lastName' => $request->lastName,
            'firstName' => $request->firstName,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthDate' => $request->birthDate,
            'birthPlace' => $request->birthPlace,
            'password' => $request->password,

        ]);

        return new UserResource($user);
    }

    public function updateUser(User $user, Request $request)
    {

        $request->validate(User::updateValidationRules($user->id), User::messages());

        $user->update($request->only([
            'lastName',
            'firstName',
            'email',
            'phone',
            'birthDate',
            'birthPlace'
        ]));

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
}
