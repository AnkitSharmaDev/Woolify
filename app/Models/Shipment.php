<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'wool_batch_id',
        'distributor_id',
        'tracking_number',
        'origin_type',
        'origin_id',
        'destination_type',
        'destination_id',
        'pickup_date',
        'estimated_delivery',
        'actual_delivery',
        'status',
        'route_details',
        'notes',
    ];

    protected $casts = [
        'route_details' => 'array',
        'pickup_date' => 'datetime',
        'estimated_delivery' => 'datetime',
        'actual_delivery' => 'datetime',
    ];

    public function woolBatch()
    {
        return $this->belongsTo(WoolBatch::class);
    }

    public function distributor()
    {
        return $this->belongsTo(Distributor::class);
    }

    public function origin()
    {
        return $this->morphTo();
    }

    public function destination()
    {
        return $this->morphTo();
    }
}