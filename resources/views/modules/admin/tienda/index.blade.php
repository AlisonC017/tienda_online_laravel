@extends('appAdmin')
@section('title', 'Tiendas')

@section('tittle', 'Admin')

@section('titulo', 'Administración')

@section('contenido')
    <div class="container-fluid py-4">
        <h4 class="fw-bold mb-3">Tiendas registradas</h4>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Logo</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Slider</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tiendas as $t)
                        <tr>
                            <td>{{ $t->id_tienda }}</td>
                            <td>
                                <img src="{{ $t->logo ? asset('uploads/' . $t->logo) : 'https://placehold.co/48x48?text=Logo' }}"
                                    class="rounded-circle" style="width:48px;height:48px;object-fit:cover"
                                    alt="Logo de {{ $t->nombre }}">
                            </td>
                            <td>{{ $t->nombre }}</td>
                            <td>{{ $t->correo ?? '—' }}</td>

                            <td class="text-center">
                                <form action="{{ route('admin.tiendas.activa', $t->id_tienda) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="btn btn-sm {{ $t->activa ? 'btn-success' : 'btn-outline-secondary' }}">
                                        {{ $t->activa ? 'Activa' : 'Inactiva' }}
                                    </button>
                                </form>
                            </td>

                            <td class="text-center">
                                <form action="{{ route('admin.tiendas.destacada', $t->id_tienda) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="btn btn-sm {{ $t->destacada ? 'btn-warning' : 'btn-outline-secondary' }}"
                                        @disabled(!$t->activa)>
                                        {{ $t->destacada ? '★ Destacada' : '☆ Destacar' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No hay tiendas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection