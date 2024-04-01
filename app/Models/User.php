<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Traits\HasMetrics;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Gate;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        HasUlids,
        HasMetrics;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable
        = [
            'name',
            'username',
            'email',
            'password',
            'role',
        ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden
        = [
            'id',
            'password',
            'remember_token',
        ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts
        = [
            'role'              => UserRole::class,
            'email_verified_at' => 'datetime',
            'last_logged_in_at' => 'datetime',
            'last_active_at'    => 'datetime',
        ];

    public function scopeOfRole(Builder $query, UserRole|string $role): void
    {
        $query->where('role', $role);
    }
}
