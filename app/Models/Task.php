<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'responsible_id',
        'title',
        'points_allocated',
        'is_completed',
        'due_date',
        'notes',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'due_date' => 'date',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function responsible()
    {
        return $this->belongsTo(User::class, 'responsible_id');
    }
}
