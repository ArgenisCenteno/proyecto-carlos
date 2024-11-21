<div class="container">
        <h2>Detalles de la Venta</h2>

        <!-- Información de la Venta -->
        <div class="form-section">
            <form>
                <div class="row">
                    <!-- Cliente -->
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="cliente">Cliente</label>
                            <input type="text" class="form-control" id="cliente" value="{{ $venta->user->name }}"
                                readonly>
                        </div>
                    </div>

                    <!-- Monto Total -->
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="monto_total">Monto Total</label>
                            <input type="text" class="form-control" id="monto_total"
                                value="{{ number_format($venta->pago->monto_total, 2) }}" readonly>
                        </div>
                    </div>

                    <!-- Monto Neto -->
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="monto_neto">Monto Neto</label>
                            <input type="text" class="form-control" id="monto_neto"
                                value="{{ number_format($venta->pago->monto_neto, 2) }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Estado del Pago -->
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="status_pago">Estado del Pago</label>
                            <input value="{{ $venta->pago->status }}" readonly class="form-control" />
                        </div>
                    </div>

                    <!-- Fecha de Venta -->
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="fecha_venta">Fecha de Venta</label>
                            <input type="text" class="form-control" id="fecha_venta"
                                value="{{ $venta->created_at->format('Y-m-d') }}" readonly>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Detalles de Venta -->

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Impuesto</th>
                    <th>Total en Dólares</th>
                    <th>Total en Bolívares</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venta->detalleVentas as $detalle)
                    <tr>
                        <td>{{ $detalle->id }}</td>
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td>{{ number_format($detalle->precio_producto, 2) }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>{{ number_format($detalle->neto, 2) }}</td>
                        <td>{{ number_format($detalle->impuesto, 2) }}</td>
                        <td>{{ number_format($detalle->impuesto + $detalle->neto, 2) }}</td>
                        <td>{{ number_format($detalle->impuesto + $detalle->neto * $dollar, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>