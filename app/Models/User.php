<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Arr;
use App\Models\Enums\UserType;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'google_id',
        'userName',
        'lastName',
        'firstName',
        'phone',
        'birthDate',
        'birthPlace',
        'otp_code',
        'email',
        'password',
        'userType',
        'otp_expires_at',
        'otp_verified_at',

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
        'userType' => UserType::class,
        'password' => 'hashed',
    ];

    public static function random(): Model
    {
        return static::inRandomOrder()->first();
    }

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
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
