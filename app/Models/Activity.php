<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'commission_id',
        'title',
        'scheduled_at',
        'status',
        'budget',
        'impact_metric',
        'notes',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'budget' => 'decimal:2',
    ];

    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
