<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'user_external_name',
        'qr_code',
        'price',
        'sold_at',
        'status',
        'event_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sold_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
