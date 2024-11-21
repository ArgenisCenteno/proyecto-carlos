<table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Venta</th>
                    <th>Costo</th>
                    <th>Fecha Entrega</th>
                    <th>Status</th>
                    <th>Aprobado Por</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entregas as $entrega)
                    <tr>
                        <td>{{ $entrega->id }}</td>
                        <td>{{ $entrega->venta->id ?? 'Sin venta' }}</td>
                        <td>{{ $entrega->costo ?? 'N/A' }}</td>
                        <td>{{ $entrega->fecha_entrega ?? 'N/A' }}</td>
                        <td>{{ $entrega->status }}</td>
                        <td>{{ $entrega->aprobadoPor->name ?? 'N/A' }}</td>
                        <td>{{ $entrega->user->name }}</td>
                        <td>
                            <a href="{{ route('entregas.edit', $entrega->id) }}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{ route('entregas.destroy', $entrega->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta entrega?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>