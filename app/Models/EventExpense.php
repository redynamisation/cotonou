<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'description',
        'amount',
        'occurred_at',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'occurred_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
