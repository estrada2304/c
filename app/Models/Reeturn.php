<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reeturn extends Model
{
    protected $table = 'returns'; // Especifica el nombre real de la tabla en la BD

    /**
     * Scope para contar registros por estado
     */
    public function scopeCountByStatus($query)
    {
        return $query->selectRaw('status, count(*) as count')
            ->groupBy('status');
    }

    // Relación con Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relación con ReturnItems
    public function items()
    {
        return $this->hasMany(ReturnItem::class);
    }
}