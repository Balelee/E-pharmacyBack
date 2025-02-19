<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

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
        'phone' => ['required', 'string']
    ]);
    $user = User::where('phone', $request->phone)->first();

    if (!$user) {
        return response()->json(['message' => 'Numéro de téléphone non trouvé'], 404);
    }

    $otp = rand(100000, 999999);
    $user->update([
        'otp_code' => $otp,
    ]);

    return response()->json([
        'message' => "Votre code OTP est :{$otp}",
    ], 200);
}

public function storeUser(User $user, Request $request)
{
 $request->validate([
    'lastName' => User::getValidationRule('lastName'),
    'firstName' => User::getValidationRule('firstName'),
    'birthDate' => User::getValidationRule('birthDate'),
    'birthPlace' => User::getValidationRule('birthPlace'),
 ]);

  $user = User::create([
        'lastName' => $request->lastName,
        'firstName' => $request->firstName,
        'phone' => $request->phone,
        'birthDate' => $request->birthDate,
        'birthPlace' => $request->birthPlace,
    ]);

    return new UserResource($user);;
}

public function updateUser(User $user, Request $request)
{
    $request->validate([
        'lastName' => User::getValidationRule('lastName'),
        'firstName' => User::getValidationRule('firstName'),
        'birthDate' => User::getValidationRule('birthDate'),
        'birthPlace' => User::getValidationRule('birthPlace'),
    ]);

    $user->update([
        'lastName' => $request->lastName,
        'firstName' => $request->firstName,
        'birthDate' => $request->birthDate,
        'birthPlace' => $request->birthPlace,
    ]);

    return new UserResource($user->refresh());
}
public function findUser(User $user) {
    return new UserResource($user->refresh());
}

    public function deleteUser(User $user) {
        $user->delete();
       return new UserResource($user);
    }



}

