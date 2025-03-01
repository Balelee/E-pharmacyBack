<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUsers() // Function de recuperation des users
    {
        $users = User::all();

        return UserResource::collection($users);
    }

    public function loginUser(Request $request) // CONNEXION DU USER
    {
        $request->validate([
            'userName' => ['required_without:email', 'string', 'max:30'],
            'email' => ['required_without:userName', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = User::where('email', $request->email)->orWhere('userName', $request->userName)->first();
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
}
