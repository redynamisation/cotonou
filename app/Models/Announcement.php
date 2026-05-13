<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'commission_id',
        'title',
        'content',
        'type',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }
}
