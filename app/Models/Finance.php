<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_flux',
        'amount',
        'commission_id',
        'event_id',
        'justificatif_path',
        'source',
        'recorded_at',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'recorded_at' => 'datetime',
    ];

    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
