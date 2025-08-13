@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="fw-bold">Histórico de Movimientos</h2>
        </div>
    </div>

    <div class="row">
        <!-- Reporte Mensual -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-kaitoke-green text-white">
                    <h5 class="mb-0">Descarga Mensual</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('history.download.monthly') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="month" class="form-label">Mes</label>
                                <select class="form-select" id="month" name="month" required>
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ now()->month == $i ? 'selected' : '' }}>
                                            {{ Carbon\Carbon::create()->month($i)->monthName }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="year" class="form-label">Año</label>
                                <select class="form-select" id="year" name="year" required>
                                    @for($i = now()->year; $i >= now()->year - 5; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-kaitoke-green">
                            <i class="bi bi-download me-1"></i> Descargar Reporte
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Reporte Anual -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-kaitoke-green text-white">
                    <h5 class="mb-0">Descarga Anual</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('history.download.annual') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="annual-year" class="form-label">Año</label>
                            <select class="form-select" id="annual-year" name="year" required>
                                @for($i = now()->year; $i >= now()->year - 5; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <button type="submit" class="btn btn-kaitoke-green">
                            <i class="bi bi-download me-1"></i> Descargar Reporte
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection