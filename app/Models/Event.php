<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'commission_id',
        'title',
        'description',
        'location',
        'start_at',
        'end_at',
        'price',
        'status',
        'poster_url',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'price' => 'decimal:2',
    ];

    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function expenses()
    {
        return $this->hasMany(EventExpense::class);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_at', '>=', now())->orderBy('start_at');
    }
}
