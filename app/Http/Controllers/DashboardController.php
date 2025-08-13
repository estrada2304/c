<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\ReturnModel; // Cambiado porque "Return" es palabra reservada
use App\Models\Export;
use App\Models\Import;
use App\Models\Client;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Muestra el panel principal con gráficos y resúmenes
     */
    public function index()
    {
        // Estadísticas principales
        $stats = [
            'total_inventory' => Inventory::count(),
            'inventory_value' => Inventory::sum('price'),
            'pending_returns' => ReturnModel::where('status', 'OP')->count(),
            'recent_exports' => Export::where('created_at', '>=', Carbon::now()->subDays(7))->count()
        ];

        // Datos para gráficos
        $chartData = [
            'returns_by_status' => $this->getReturnsByStatus(),
            'exports_last_month' => $this->getExportsLastMonth(),
            'inventory_by_category' => $this->getInventoryByCategory()
        ];

        // Últimos movimientos
        $latestActivity = [
            'returns' => ReturnModel::with('client')->latest()->take(5)->get(),
            'exports' => Export::latest()->take(5)->get(),
            'imports' => Import::latest()->take(5)->get()
        ];

        return view('dashboard.index', compact('stats', 'chartData', 'latestActivity'));
    }

    /**
     * Obtiene datos de devoluciones por estado para gráfico
     */
    private function getReturnsByStatus()
    {
        return [
            'OP' => ReturnModel::where('status', 'OP')->count(),
            'CO' => ReturnModel::where('status', 'CO')->count(),
            'CL' => ReturnModel::where('status', 'CL')->count()
        ];
    }

    /**
     * Obtiene exportaciones de los últimos 30 días
     */
    private function getExportsLastMonth()
    {
        return Export::where('created_at', '>=', Carbon::now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date');
    }

    /**
     * Obtiene inventario por categoría
     */
    private function getInventoryByCategory()
    {
        return Inventory::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->get()
            ->pluck('count', 'category');
    }
}