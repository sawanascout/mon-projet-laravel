<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'segment','whatsapp',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // Un utilisateur peut avoir plusieurs commandes
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    

    // Un utilisateur peut avoir plusieurs produits personnalisés
    public function customProducts()
    {
        return $this->hasMany(CustomProduct::class);
    }
    // User.php
protected static function boot()
{
    parent::boot();

    static::creating(function ($user) {
        $user->referral_code = self::generateUniqueReferralCode();
    });
}

public static function generateUniqueReferralCode()
{
    do {
        $code = strtoupper(substr(bin2hex(random_bytes(3)), 0, 6)); // ex: 6 chars hex
    } while (self::where('referral_code', $code)->exists());

    return $code;
}
public function filleuls()
{
    return $this->hasMany(User::class, 'parrain_id');
}

public function commandes()
{
    return $this->hasMany(Order::class);
}


}
