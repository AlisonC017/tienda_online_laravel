@php
    $estado = $estado ?: 'En espera';
    $clases = [
        'En espera' => 'badge-warning',
        'En preparación' => 'badge-warning',
        'Listo' => 'badge-success',
        'Entregado' => 'badge-primary',
    ];
@endphp
<span class="badge {{ $clases[$estado] ?? 'badge-secondary' }}">{{ $estado }}</span>