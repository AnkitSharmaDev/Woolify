<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchProcess extends Model
{
    use HasFactory;

    protected $fillable = [
        'wool_batch_id',
        'processing_unit_id',
        'process_type',
        'start_time',
        'end_time',
        'status',
        'parameters',
        'notes',
        'quality_checks',
    ];

    protected $casts = [
        'parameters' => 'array',
        'quality_checks' => 'array',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function woolBatch()
    {
        return $this->belongsTo(WoolBatch::class);
    }

    public function processingUnit()
    {
        return $this->belongsTo(ProcessingUnit::class);
    }
}