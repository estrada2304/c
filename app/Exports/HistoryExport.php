<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HistoryExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        // Obtener movimientos de todas las tablas relevantes
        $inventory = DB::table('inventories')
            ->select('id', 'serial', 'created_at', DB::raw("'Inventario' as tipo"))
            ->whereBetween('created_at', [$this->startDate, $this->endDate]);
            
        $returns = DB::table('returns')
            ->select('id', 'serial_entregado as serial', 'created_at', DB::raw("'Devolución' as tipo"))
            ->whereBetween('created_at', [$this->startDate, $this->endDate]);
            
        $exports = DB::table('exports')
            ->select('id', 'serial_a_enviar as serial', 'created_at', DB::raw("'Exportación' as tipo"))
            ->whereBetween('created_at', [$this->startDate, $this->endDate]);
            
        $imports = DB::table('imports')
            ->select('id', 'serial_a_recibir as serial', 'created_at', DB::raw("'Importación' as tipo"))
            ->whereBetween('created_at', [$this->startDate, $this->endDate]);
            
        return $inventory->union($returns)
                        ->union($exports)
                        ->union($imports)
                        ->orderBy('created_at', 'desc')
                        ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Serial',
            'Fecha',
            'Tipo de Movimiento'
        ];
    }
}