<form action="{{ route('entregas.update', $entrega->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-3 mb-3">
            <label for="venta_id" class="form-label">Venta</label>
            <input type="text" class="form-control" id="venta_id" value="{{ $entrega->venta->id ?? 'Sin venta' }}" readonly>
        </div>

        <div class="col-md-3 mb-3">
            <label for="costo" class="form-label">Costo</label>
            <input type="text" class="form-control" id="costo" value="{{ $entrega->costo ?? 'N/A' }}" readonly>
        </div>

        <div class="col-md-3 mb-3">
            <label for="fecha_entrega" class="form-label">Fecha de Entrega</label>
            <input type="text" class="form-control" id="fecha_entrega" value="{{ $entrega->fecha_entrega ?? 'N/A' }}" readonly>
        </div>
        @if(Auth::check() && Auth::user()->hasRole('superAdmin') || Auth::user()->hasRole('empleado'))
        <div class="col-md-3 mb-3">
            <label for="status" class="form-label">Estatus</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Pendiente" {{ $entrega->status == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="En Proceso" {{ $entrega->status == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                <option value="Completado" {{ $entrega->status == 'Completado' ? 'selected' : '' }}>Completado</option>
            </select>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-3 mb-3">
            <label for="aprobado_por" class="form-label">Aprobado Por</label>
            <input type="text" class="form-control" id="aprobado_por" value="{{ $entrega->aprobadoPor->name ?? 'N/A' }}" readonly>
        </div>

        <div class="col-md-3 mb-3">
            <label for="user_id" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="user_id" value="{{ $entrega->user->name }}" readonly>
        </div>

       
    </div>
     <div class="col-md-3 mb-3">
            <button type="submit" class="btn btn-primary ">Actualizar</button>
        </div>

        
</form>
