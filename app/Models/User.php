<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Enums\ModelStatus;
use App\Models\Enums\UserType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;

/**
 * @mixin IdeHelperUser
 */
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
        'type',
        'status',
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
        'type' => UserType::class,
        'status' => ModelStatus::class,
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
 

    public function pharmacie()
    {
        return $this->hasOne(Pharmacy::class, 'pharmacien_id');
    }

    public function scopeNotAdmin(Builder $query): Builder
    {
        return $query->whereNot('type', UserType::ADMIN)->with('pharmacie');
    }

    public function getPharmacieNameAttribute()
    {
        if ($this->userType !== UserType::PHARMACIEN) {
            return null;
        }

        return $this->pharmacie?->name;
    }

    public static function validationRules()
    {
        return [
            'userName' => ['required', 'string', 'max:255', 'unique:users,userName'],
            'lastName' => ['required', 'string', 'max:255'],
            'firstName' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:12', 'unique:users,phone'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'birthDate' => ['required', 'date'],
            'birthPlace' => ['required', 'string', 'max:255'],
        ];
    }


    public static function messages()
{
    return [
        'email.unique'    => __('validation.custom.email.unique'),
        'phone.unique'    => __('validation.custom.phone.unique'),
        'userName.unique' => __('validation.custom.userName.unique'),
    ];
}

}
