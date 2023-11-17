<?php

namespace App\Models;

use App\Casts\VerificationCodeCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
        'google_id',
        'facebook_id',
        'name',
        'email',
        "phone",
        "verification_code",
        "verification_code_expiration",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'verification_code' => VerificationCodeCast::class,
        'verification_code_expiration' => 'datetime:Y-m-d H:i:s',
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public static function findByEmail(string $email): ?User
    {
        return User::whereEmail($email)->first();
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
