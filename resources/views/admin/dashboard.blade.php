@extends('layouts.app')

@section('title', 'Panel Administrativo')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 1rem 0;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 1.8rem; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; color: var(--gold-light);">
                Panel de Administración
            </h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">
                Bienvenido, {{ Auth::user()->nombre_completo }}. Control general del sistema Controlux.
            </p>
        </div>
        <div style="display: flex; gap: 0.8rem;">
            <a href="{{ route('home') }}" class="btn-outline-gold" style="font-size: 0.8rem;">
                Ver Tienda
            </a>
        </div>
    </div>

    <!-- Tarjetas de Estadísticas Rápidas -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
        <div class="glass-card" style="padding: 1.5rem;">
            <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); display: block; margin-bottom: 0.5rem;">Total Usuarios</span>
            <div style="font-size: 2rem; font-weight: 800; color: var(--gold-light);">{{ \App\Models\User::count() }}</div>
            <span style="font-size: 0.75rem; color: #70EF8B;">Clientes registrados</span>
        </div>

        <div class="glass-card" style="padding: 1.5rem;">
            <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); display: block; margin-bottom: 0.5rem;">Productos</span>
            <div style="font-size: 2rem; font-weight: 800; color: var(--gold);">{{ \App\Models\Producto::count() }}</div>
            <span style="font-size: 0.75rem; color: var(--text-muted);">En catálogo</span>
        </div>

        <div class="glass-card" style="padding: 1.5rem;">
            <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); display: block; margin-bottom: 0.5rem;">Categorías</span>
            <div style="font-size: 2rem; font-weight: 800; color: var(--gold-light);">{{ \App\Models\Categoria::count() }}</div>
            <span style="font-size: 0.75rem; color: var(--text-muted);">Relojes, Perfumes, Accesorios</span>
        </div>

        <div class="glass-card" style="padding: 1.5rem;">
            <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); display: block; margin-bottom: 0.5rem;">Pedidos</span>
            <div style="font-size: 2rem; font-weight: 800; color: var(--gold);">{{ \App\Models\Pedido::count() }}</div>
            <span style="font-size: 0.75rem; color: var(--text-muted);">Historial de compras</span>
        </div>
    </div>

    <!-- Módulos de Gestión -->
    <div class="glass-card">
        <h2 style="font-size: 1.1rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--gold); margin-bottom: 1.5rem; border-bottom: 1px solid rgba(212,175,55,0.2); padding-bottom: 0.8rem;">
            Gestión del Sistema
        </h2>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem;">
            <div style="padding: 1.2rem; background: rgba(255,255,255,0.02); border: 1px solid rgba(212,175,55,0.15); border-radius: 8px;">
                <h3 style="font-size: 0.95rem; color: var(--gold-light); margin-bottom: 0.4rem;">Gestión de Productos</h3>
                <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 1rem;">Crear, editar, activar o cambiar stock de productos.</p>
                <span style="font-size: 0.75rem; color: var(--gold); font-weight: 600;">Próximo módulo &rarr;</span>
            </div>

            <div style="padding: 1.2rem; background: rgba(255,255,255,0.02); border: 1px solid rgba(212,175,55,0.15); border-radius: 8px;">
                <h3 style="font-size: 0.95rem; color: var(--gold-light); margin-bottom: 0.4rem;">Gestión de Pedidos</h3>
                <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 1rem;">Monitorear estados de envío (Recibido, Empacado, Enviado).</p>
                <span style="font-size: 0.75rem; color: var(--gold); font-weight: 600;">Próximo módulo &rarr;</span>
            </div>

            <div style="padding: 1.2rem; background: rgba(255,255,255,0.02); border: 1px solid rgba(212,175,55,0.15); border-radius: 8px;">
                <h3 style="font-size: 0.95rem; color: var(--gold-light); margin-bottom: 0.4rem;">Categorías y Marcas</h3>
                <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 1rem;">Administrar subcategorías y marcas aliadas.</p>
                <span style="font-size: 0.75rem; color: var(--gold); font-weight: 600;">Próximo módulo &rarr;</span>
            </div>
        </div>
    </div>
</div>
@endsection
