<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'name',
        'email',
        'phone_number',
        'role',
        'avatar',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getAvatar()
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        return asset('dashboard_/img/undraw_profile.svg');
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $options = array_merge([
            'search' => '',
        ], $filters);

        $builder->when($options['search'], function (Builder $builder, $search) {
            $builder->where('name', 'LIKE', "%$search%")->orWhere('email', 'LIKE', "%$search%");
        });
    }
}
