@extends('layout.app')

@section('content')

<main id="main" class="main">
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="bg-primary text-white p-3 d-flex align-items-center justify-content-between rounded-top">
                        <h3 class="mb-0">Notificaciones</h3>
                        <!-- Botón para marcar todas como leídas -->
                        <form action="{{ route('notificaciones.markAllAsRead') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light btn-sm">Marcar todas como leídas</button>
                        </form>
                    </div>

                    <div class="p-4 border border-top-0 rounded-bottom shadow-sm bg-white">
                        @include('flash::message')

                        <!-- Lista de notificaciones -->
                        <ul class="list-group mt-3">
                            @forelse($notificaciones as $notificacion)
                                <li class="list-group-item d-flex justify-content-between align-items-start {{ $notificacion->read_at ? '' : 'bg-light' }}">
                                    <div>
                                        <a href="{{ $notificacion->data['url'] }}" class="text-decoration-none text-dark">
                                            <strong>{{ $notificacion->data['mensaje'] ?? 'Notificación' }}</strong>
                                            <p class="mb-1 text-muted">{{ $notificacion->created_at->diffForHumans() }}</p>
                                            @if(isset($notificacion->data['type']))
                                                <span class="badge bg-secondary">{{ $notificacion->data['type'] }}</span>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <!-- Botón para marcar como leída individualmente -->
                                        @if(is_null($notificacion->read_at))
                                            <form action="{{ route('notificaciones.markAsRead', $notificacion->id) }}" method="POST" class="me-2">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Marcar como leída</button>
                                            </form>
                                        @endif

                                        <!-- Botón para eliminar la notificación -->
                                        <form action="{{ route('notificaciones.destroy', $notificacion->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item text-center">No hay notificaciones.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
