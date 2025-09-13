<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // get all users for admin
    public function getUsers()
    {
        $users = User::with('pharmacie')->get();
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

        // Attribution de la pharmacie si fourni
        $pharmacy = Pharmacy::find($request->pharmacy_id);
        $pharmacy->update(['pharmacien_id' => $user->id]);

        return new UserResource($user->load('pharmacie'));
    }

    public function loginUser(Request $request) // CONNEXION DU USER
    {
        $request->validate([
            'phone' => ['required_without:email', 'string', 'max:30'],
            'email' => ['required_without:phone', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = User::where('email', $request->email)->orWhere('phone', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.'],
            ], 404);
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
            'userName' => User::getValidationRule('userName'),
            'lastName' => User::getValidationRule('lastName'),
            'firstName' => User::getValidationRule('firstName'),
            'birthDate' => User::getValidationRule('birthDate'),
            'birthPlace' => User::getValidationRule('birthPlace'),
            'email' => User::getValidationRule('email'),
            'phone' => User::getValidationRule('phone'),
            'password' => User::getValidationRule('password'),
        ]);

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
        $request->validate([
            'userName' => User::getValidationRule('userName'),
            'lastName' => User::getValidationRule('lastName'),
            'firstName' => User::getValidationRule('firstName'),
            'birthDate' => User::getValidationRule('birthDate'),
            'birthPlace' => User::getValidationRule('birthPlace'),
            'email' => User::getValidationRule('email'),
            'phone' => User::getValidationRule('phone'),
        ]);

        $user->update([
            'userName' => $request->userName,
            'lastName' => $request->lastName,
            'firstName' => $request->firstName,
            'email' => $request->email,
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
}
