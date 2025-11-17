@extends('admin.layout')

@section('title', 'Mi Cuenta - IMPEERCOL')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Mi Cuenta</h2>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-outline-danger">
            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
        </button>
    </form>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="bi bi-person-circle" style="font-size: 4rem; color: #667eea;"></i>
                </div>
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="text-muted mb-2">{{ $user->email }}</p>
                <span class="badge bg-info">{{ ucfirst($user->role) }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Información de la Cuenta</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Bienvenido a tu área de cliente</strong>
                </div>
                
                <p class="text-muted">
                    Esta sección está preparada para mostrar el estado de tus pedidos y servicios cuando estén disponibles.
                </p>

                <div class="mt-4">
                    <h6>Funcionalidades próximas:</h6>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle text-success me-2"></i> Ver estado de pedidos</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i> Historial de servicios</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i> Descargar documentos</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i> Actualizar información personal</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Mis Pedidos</h5>
            </div>
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                <p class="text-muted mt-3">No hay pedidos disponibles aún.</p>
                <p class="text-muted small">Cuando realices un pedido, aparecerá aquí.</p>
            </div>
        </div>
    </div>
</div>
@endsection

