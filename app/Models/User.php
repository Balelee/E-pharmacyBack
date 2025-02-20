<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userName',
        'lastName',
        'firstName',
        'phone',
        'birthDate',
        'birthPlace',
        'otp_code',
        'email',
        'password',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthDate' => 'date',
        'password' => 'hashed',
    ];

    public static function getValidationRule(string $name): array
    {
        return Arr::get(static::validationRules(), $name, []);
    }

    public static function validationRules()
    {
        return [
            'userName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'firstName' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numercic'],
            'password' => ['required', 'string'],
            'birthDate' => ['required', 'date'],
            'birthPlace' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'max:8'],
        ];
    }
}
