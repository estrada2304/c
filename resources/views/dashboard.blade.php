@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Estadísticas Rápidas -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Inventario Total</h5>
                    <h2>{{ $stats['total_inventory'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Valor Total</h5>
                    <h2>${{ number_format($stats['inventory_value'], 2) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5 class="card-title">Devoluciones Pendientes</h5>
                    <h2>{{ $stats['pending_returns'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Exportaciones (7 días)</h5>
                    <h2>{{ $stats['recent_exports'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Devoluciones por Estado</div>
                <div class="card-body">
                    <canvas id="returnsChart" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Equipos en Exportaciones (Últimos 30 días)</div>
                <div class="card-body">
                    <canvas id="exportsChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Últimos Movimientos -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Últimas Devoluciones</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($latestActivity['returns'] as $return)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>RMA:</strong> {{ $return->rma }}<br>
                                <small>Cliente: {{ $return->client->name ?? 'N/A' }}</small>
                            </div>
                            <span class="badge bg-{{ $return->status == 'OP' ? 'warning' : ($return->status == 'CO' ? 'success' : 'danger') }}">
                                {{ $return->status }}
                            </span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Últimas Exportaciones</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($latestActivity['exports'] as $export)
                        <li class="list-group-item">
                            <strong>Serial:</strong> {{ $export->serial }}<br>
                            <small>Guía: {{ $export->tracking_number }} | {{ $export->created_at->diffForHumans() }}</small>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de Devoluciones por Estado
    new Chart(document.getElementById('returnsChart'), {
        type: 'bar',
        data: {
            labels: ['Abiertas (OP)', 'Completadas (CO)', 'Cerradas (CL)'],
            datasets: [{
                label: 'Cantidad',
                data: [
                    {{ $chartData['returns_by_status']['OP'] }},
                    {{ $chartData['returns_by_status']['CO'] }},
                    {{ $chartData['returns_by_status']['CL'] }}
                ],
                backgroundColor: [
                    'rgba(255, 193, 7, 0.7)',
                    'rgba(40, 167, 69, 0.7)',
                    'rgba(220, 53, 69, 0.7)'
                ],
                borderColor: [
                    'rgb(255, 193, 7)',
                    'rgb(40, 167, 69)',
                    'rgb(220, 53, 69)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Gráfico de Exportaciones
    new Chart(document.getElementById('exportsChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($chartData['exports_last_month']->toArray())) !!},
            datasets: [{
                label: 'Exportaciones diarias',
                data: {!! json_encode(array_values($chartData['exports_last_month']->toArray())) !!},
                backgroundColor: 'rgba(46, 204, 113, 0.2)',
                borderColor: '#2ecc71',
                borderWidth: 2,
                tension: 0.1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endsection
@endsection