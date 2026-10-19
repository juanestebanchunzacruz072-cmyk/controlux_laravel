@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div style="max-width: 1000px; margin: 0 auto; padding: 1rem 0;">
    <!-- Encabezado de Perfil -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 1.8rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--text-main);">
                Mi Perfil
            </h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">
                Gestiona tus datos personales y direcciones de entrega
            </p>
        </div>
        <div>
            <span style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(184, 134, 11, 0.08); border: 1px solid var(--gold-border); padding: 0.4rem 1rem; border-radius: 50px; font-size: 0.82rem; font-weight: 600; color: var(--gold-dark);">
                <span style="width: 8px; height: 8px; border-radius: 50%; background: var(--gold);"></span>
                Rol: {{ $user->rol->nombre ?? 'Cliente' }}
            </span>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
        <!-- Columna 1: Información Personal (Sólo lectura RF-05) -->
        <div>
            <div class="glass-card" style="margin-bottom: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; border-bottom: 1px solid var(--gold-border); padding-bottom: 0.8rem;">
                    <h2 style="font-size: 1.05rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--gold-dark);">
                        Información Personal
                    </h2>
                    <span style="font-size: 0.72rem; color: var(--text-muted); background: rgba(0,0,0,0.04); padding: 3px 8px; border-radius: 4px;">
                        Protegido
                    </span>
                </div>

                <div style="display: flex; flex-direction: column; gap: 1.2rem;">
                    <div>
                        <span style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); display: block;">Nombre Completo</span>
                        <strong style="font-size: 1rem; color: var(--text-main);">{{ $user->nombre_completo }}</strong>
                    </div>

                    <div>
                        <span style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); display: block;">Correo Electrónico</span>
                        <span style="font-size: 0.95rem; color: var(--text-main);">{{ $user->correo }}</span>
                    </div>

                    <div>
                        <span style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); display: block;">Documento / Cédula</span>
                        <span style="font-size: 0.95rem; color: var(--text-main);">{{ $user->cedula ?? 'No registrada' }}</span>
                    </div>

                    <div>
                        <span style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); display: block;">Fecha de Registro</span>
                        <span style="font-size: 0.85rem; color: var(--text-muted);">{{ $user->fecha_registro ? \Carbon\Carbon::parse($user->fecha_registro)->format('d/m/Y h:i A') : 'N/A' }}</span>
                    </div>
                </div>

                <div style="margin-top: 1.5rem; padding: 0.8rem; background: #F9F9FB; border-left: 3px solid var(--gold); border-radius: 4px; font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
                    Por motivos de seguridad (RF-05), los datos de identidad no pueden ser modificados. Si requieres un cambio, contacta a soporte.
                </div>
            </div>

            <!-- Cambio de Contraseña -->
            <div class="glass-card">
                <h2 style="font-size: 1.05rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--gold-dark); margin-bottom: 1.5rem; border-bottom: 1px solid var(--gold-border); padding-bottom: 0.8rem;">
                    Seguridad de la Cuenta
                </h2>

                <form method="POST" action="{{ route('perfil.password') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="current_password" class="form-label">Contraseña Actual *</label>
                        <input type="password" id="current_password" name="current_password" class="form-control" required>
                        @error('current_password') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="new_password" class="form-label">Nueva Contraseña *</label>
                        <input type="password" id="new_password" name="password" class="form-control" required>
                        @error('password') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn-outline-gold" style="width: 100%;">
                        Actualizar Contraseña
                    </button>
                </form>
            </div>
        </div>

        <!-- Columna 2: Datos de Envío Editables (RF-05) & Historial de Pedidos -->
        <div>
            <!-- Formulario de Envío Editable -->
            <div class="glass-card" style="margin-bottom: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; border-bottom: 1px solid var(--gold-border); padding-bottom: 0.8rem;">
                    <h2 style="font-size: 1.05rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--gold-dark);">
                        Datos de Envío & Entrega
                    </h2>
                    <span style="font-size: 0.72rem; color: var(--gold-dark); background: rgba(184,134,11,0.1); padding: 3px 8px; border-radius: 4px; font-weight: 600;">
                        Editable
                    </span>
                </div>

                <form method="POST" action="{{ route('perfil.shipping') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="telefono" class="form-label">Teléfono de Contacto</label>
                        <input type="tel" id="telefono" name="telefono" value="{{ old('telefono', $user->telefono) }}" class="form-control" placeholder="Ej. 3131234567">
                        @error('telefono') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="direccion" class="form-label">Dirección de Entrega *</label>
                        <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $user->direccion) }}" class="form-control" placeholder="Ej. Cra 15 #85-30 Apto 402" required>
                        @error('direccion') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label for="barrio" class="form-label">Barrio *</label>
                            <input type="text" id="barrio" name="barrio" value="{{ old('barrio', $user->barrio) }}" class="form-control" placeholder="Ej. El Poblado" required>
                            @error('barrio') <span class="form-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="ciudad" class="form-label">Ciudad *</label>
                            <input type="text" id="ciudad" name="ciudad" value="{{ old('ciudad', $user->ciudad) }}" class="form-control" placeholder="Ej. Medellín" required>
                            @error('ciudad') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn-gold" style="width: 100%; margin-top: 0.5rem;">
                        Guardar Datos de Envío
                    </button>
                </form>
            </div>

            <!-- Historial Rápido de Pedidos (RF-17) -->
            <div class="glass-card">
                <h2 style="font-size: 1.05rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--gold-dark); margin-bottom: 1.2rem; border-bottom: 1px solid var(--gold-border); padding-bottom: 0.8rem;">
                    Mis Últimos Pedidos
                </h2>

                @if($pedidos->count() > 0)
                    <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                        @foreach($pedidos as $pedido)
                            <div style="padding: 0.8rem 1rem; background: #F9F9FB; border: 1px solid var(--gold-border); border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <strong style="color: var(--gold-dark); font-size: 0.9rem;">Pedido #{{ $pedido->id_pedido }}</strong>
                                    <div style="font-size: 0.75rem; color: var(--text-muted);">{{ \Carbon\Carbon::parse($pedido->fecha_pedido)->format('d/m/Y') }}</div>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-weight: 700; color: var(--text-main); font-size: 0.95rem;">{{ $pedido->total_formateado }}</div>
                                    <span style="font-size: 0.72rem; padding: 2px 6px; border-radius: 4px; background: rgba(184,134,11,0.1); color: var(--gold-dark); font-weight: 600;">
                                        {{ $pedido->estado->nombre ?? 'Pendiente' }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 2rem 1rem; color: var(--text-muted); font-size: 0.88rem;">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 0.5rem; opacity: 0.5;">
                            <circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        <p>Aún no has realizado ningún pedido.</p>
                        <a href="{{ route('home') }}" class="btn-outline-gold" style="margin-top: 1rem; font-size: 0.78rem;">
                            Explorar Catálogo
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
