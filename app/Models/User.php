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

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'commission_id',
        'points_motivation',
        'school',
        'member_code',
        'avatar_path',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'points_motivation' => 'integer',
        ];
    }

    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'responsible_id');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isCommissionLead(): bool
    {
        return str_contains($this->role, 'lead');
    }
}
