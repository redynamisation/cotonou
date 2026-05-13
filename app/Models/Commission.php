<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'attributions',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
}
