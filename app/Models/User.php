<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'segment',
        'password',
        'role',
        'telephone',
        'referral_code',
        'parrain_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relation vers le parrain (utilisateur référent)
     */
     protected static function booted()
    {
         static::creating(function ($user) {
        $user->referral_code = self::generateUniqueParrainageCode();
    });
        static::created(function ($user) {
            // Crée un panier pour ce nouvel utilisateur
            $user->panier()->create();
        });
    }
    public static function generateUniqueParrainageCode($length = 8)
    {
        do {
            $code = Str::upper(Str::random($length));
        } while (self::where('referral_code', $code)->exists());

        return $code;
    }

    public function parrain()
    {
        return $this->belongsTo(User::class, 'parrain_id');
    }

    /**
     * Relation vers les filleuls (utilisateurs référés par cet utilisateur)
     */
    public function filleuls()
    {
        return $this->hasMany(User::class, 'parrain_id');
    }

    public function panier()
{
    return $this->hasOne(Paniers::class);
}
public function commandes()
{
    return $this->hasMany(Commandes::class, 'user_id');
}
public function referralClicks()
{
    return $this->hasMany(Referral_click::class);
}


}
