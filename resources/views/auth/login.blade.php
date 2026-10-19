@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div style="min-height: 70vh; display: flex; align-items: center; justify-content: center; padding: 1rem 0;">
    <div class="glass-card" style="max-width: 460px; width: 100%; position: relative; overflow: hidden;">
        <!-- Elemento decorativo dorado -->
        <div style="position: absolute; top: -50px; right: -50px; width: 130px; height: 130px; background: radial-gradient(circle, rgba(212,175,55,0.2) 0%, transparent 70%); pointer-events: none;"></div>

        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="display: inline-flex; padding: 12px; background: rgba(212, 175, 55, 0.08); border: 1px solid var(--gold-border); border-radius: 50%; margin-bottom: 1rem;">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
            </div>
            <h1 style="font-size: 1.6rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--gold-light); margin-bottom: 0.4rem;">
                Iniciar Sesión
            </h1>
            <p style="color: var(--text-muted); font-size: 0.85rem;">
                Accede a tu cuenta exclusiva de Controlux
            </p>
        </div>

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <!-- Correo electrónico -->
            <div class="form-group">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <div style="position: relative;">
                    <input 
                        type="email" 
                        id="correo" 
                        name="correo" 
                        value="{{ old('correo') }}" 
                        class="form-control" 
                        placeholder="tu@correo.com"
                        required 
                        autocomplete="email" 
                        autofocus
                    >
                </div>
                @error('correo')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="form-group">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.45rem;">
                    <label for="password" class="form-label" style="margin-bottom: 0;">Contraseña</label>
                </div>
                <div style="position: relative;">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-control" 
                        placeholder="••••••••" 
                        required 
                        autocomplete="current-password"
                    >
                    <button 
                        type="button" 
                        id="togglePassword" 
                        style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--text-muted); cursor: pointer; padding: 4px;"
                        aria-label="Mostrar contraseña"
                    >
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Recordarme -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin: 1.2rem 0 1.8rem 0; font-size: 0.85rem;">
                <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-muted); cursor: pointer;">
                    <input type="checkbox" name="remember" id="remember" style="accent-color: var(--gold); cursor: pointer;">
                    <span>Recordar mi sesión</span>
                </label>
            </div>

            <!-- Botón de Envío -->
            <button type="submit" class="btn-gold" style="width: 100%; padding: 0.85rem; font-size: 0.95rem;">
                Acceder a Mi Cuenta
            </button>
        </form>

        <div style="text-align: center; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(255, 255, 255, 0.08); font-size: 0.85rem; color: var(--text-muted);">
            ¿Aún no tienes una cuenta? 
            <a href="{{ route('registro') }}" style="color: var(--gold); font-weight: 600; text-decoration: underline;">
                Regístrate aquí
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('togglePassword');
        const passInput = document.getElementById('password');

        if (toggleBtn && passInput) {
            toggleBtn.addEventListener('click', function () {
                const isPassword = passInput.type === 'password';
                passInput.type = isPassword ? 'text' : 'password';
                toggleBtn.style.color = isPassword ? 'var(--gold)' : 'var(--text-muted)';
            });
        }
    });
</script>
@endpush
