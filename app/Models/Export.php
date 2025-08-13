<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Export extends Model
{
    protected $fillable = [
        'part_code',
        'serial',
        'category',
        'tracking_number',
        'collection_date',
        'delivery_date_malaysia',
        'rma',
        'status',
        'notes'
    ];

    protected $casts = [
        'collection_date' => 'date',
        'delivery_date_malaysia' => 'date'
    ];

    /**
     * Relación con el inventario (usando serial como clave)
     */
    public function inventoryItem(): HasOne
    {
        return $this->hasOne(Inventory::class, 'serial', 'serial');
    }

    /**
     * Relación con devolución (si aplica)
     */
    public function return(): BelongsTo
    {
        return $this->belongsTo(ReturnModel::class, 'rma', 'rma');
    }

    /**
     * Scope para exportaciones recientes
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('collection_date', '>=', now()->subDays($days));
    }

    /**
     * Scope para exportaciones por estado
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}