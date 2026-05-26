<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecurringInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'frequency',
        'amount',
        'next_run_date',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'next_run_date' => 'date',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
