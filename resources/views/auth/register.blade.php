@extends('layouts.app')

@section('title', 'Crear Cuenta')

@section('content')
<div style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 2rem 0;">
    <div class="glass-card" style="max-width: 780px; width: 100%; position: relative; overflow: hidden;">
        <!-- Elemento decorativo dorado -->
        <div style="position: absolute; top: -60px; right: -60px; width: 160px; height: 160px; background: radial-gradient(circle, rgba(212,175,55,0.15) 0%, transparent 70%); pointer-events: none;"></div>

        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="display: inline-flex; padding: 12px; background: rgba(184, 134, 11, 0.08); border: 1px solid var(--gold-border); border-radius: 50%; margin-bottom: 1rem;">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <line x1="20" y1="8" x2="20" y2="14"></line>
                    <line x1="23" y1="11" x2="17" y2="11"></line>
                </svg>
            </div>
            <h1 style="font-size: 1.6rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--text-main); margin-bottom: 0.4rem;">
                Registro de Cliente
            </h1>
            <p style="color: var(--text-muted); font-size: 0.85rem;">
                Únete al club exclusivo de clientes Controlux
            </p>
        </div>

        <form method="POST" action="{{ route('registro') }}" novalidate>
            @csrf

            <!-- Sección: Información Personal -->
            <div style="margin-bottom: 1.5rem;">
                <div style="font-size: 0.75rem; font-weight: 700; letter-spacing: 1.5px; color: var(--gold-dark); text-transform: uppercase; margin-bottom: 1rem; border-bottom: 1px solid var(--gold-border); padding-bottom: 0.4rem;">
                    1. Información Personal
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;">
                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre *</label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" class="form-control" placeholder="Ej. Wilson" required>
                        @error('nombre') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="apellido" class="form-label">Apellido *</label>
                        <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}" class="form-control" placeholder="Ej. Romero" required>
                        @error('apellido') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="cedula" class="form-label">Cédula / Documento</label>
                        <input type="text" id="cedula" name="cedula" value="{{ old('cedula') }}" class="form-control" placeholder="Ej. 1023456789">
                        @error('cedula') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Sección: Contacto & Acceso -->
            <div style="margin-bottom: 1.5rem;">
                <div style="font-size: 0.75rem; font-weight: 700; letter-spacing: 1.5px; color: var(--gold-dark); text-transform: uppercase; margin-bottom: 1rem; border-bottom: 1px solid var(--gold-border); padding-bottom: 0.4rem;">
                    2. Contacto & Credenciales de Acceso
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;">
                    <div class="form-group">
                        <label for="correo" class="form-label">Correo Electrónico *</label>
                        <input type="email" id="correo" name="correo" value="{{ old('correo') }}" class="form-control" placeholder="tu@correo.com" required>
                        @error('correo') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="telefono" class="form-label">Teléfono / WhatsApp</label>
                        <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}" class="form-control" placeholder="Ej. 3101234567">
                        @error('telefono') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;">
                    <div class="form-group">
                        <label for="password" class="form-label">Contraseña (Mínimo 6 caracteres) *</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                        @error('password') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>
            </div>

            <!-- Sección: Dirección de Envío -->
            <div style="margin-bottom: 1.8rem;">
                <div style="font-size: 0.75rem; font-weight: 700; letter-spacing: 1.5px; color: var(--gold-dark); text-transform: uppercase; margin-bottom: 1rem; border-bottom: 1px solid var(--gold-border); padding-bottom: 0.4rem;">
                    3. Dirección de Envío (Para entregas y pedidos)
                </div>

                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" class="form-control" placeholder="Calle 123 #45-67">
                        @error('direccion') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="barrio" class="form-label">Barrio</label>
                        <input type="text" id="barrio" name="barrio" value="{{ old('barrio') }}" class="form-control" placeholder="Centro">
                        @error('barrio') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="ciudad" class="form-label">Ciudad</label>
                        <input type="text" id="ciudad" name="ciudad" value="{{ old('ciudad') }}" class="form-control" placeholder="Bogotá">
                        @error('ciudad') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-gold" style="width: 100%; padding: 0.9rem; font-size: 0.95rem;">
                Crear Mi Cuenta Exclusiva
            </button>
        </form>

        <div style="text-align: center; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(0, 0, 0, 0.08); font-size: 0.85rem; color: var(--text-muted);">
            ¿Ya tienes una cuenta registrada? 
            <a href="{{ route('login') }}" style="color: var(--gold-dark); font-weight: 700; text-decoration: underline;">
                Inicia sesión aquí
            </a>
        </div>
    </div>
</div>
@endsection
