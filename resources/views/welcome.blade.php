@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div style="padding: 2rem 0;">
    <!-- Hero Banner Exclusivo -->
    <div class="glass-card" style="text-align: center; padding: 4.5rem 2rem; position: relative; overflow: hidden; margin-bottom: 3.5rem;">
        <div style="position: absolute; top: -100px; left: 50%; transform: translateX(-50%); width: 400px; height: 300px; background: radial-gradient(circle, rgba(212,175,55,0.15) 0%, transparent 70%); pointer-events: none;"></div>

        <span style="display: inline-block; font-size: 0.78rem; font-weight: 700; letter-spacing: 3px; color: var(--gold); text-transform: uppercase; margin-bottom: 1rem; border: 1px solid var(--gold-border); padding: 5px 16px; border-radius: 50px;">
            Colección Exclusiva 2026
        </span>

        <h1 style="font-size: clamp(2.2rem, 5vw, 3.8rem); font-weight: 800; letter-spacing: 3px; text-transform: uppercase; line-height: 1.15; margin-bottom: 1.2rem; background: var(--gold-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            Distinción & Lujo
        </h1>

        <p style="max-width: 650px; margin: 0 auto 2.2rem auto; font-size: 1rem; color: var(--text-muted); line-height: 1.7;">
            Descubre nuestra cuidada selección de relojes de alta gama, réplicas suizas de precisión, perfumería importada y accesorios de marroquinería premium.
        </p>

        <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
            <a href="#catalogo" class="btn-gold" style="padding: 0.85rem 2rem;">
                Explorar Colecciones
            </a>
            @guest
                <a href="{{ route('registro') }}" class="btn-outline-gold" style="padding: 0.85rem 1.8rem;">
                    Crear Cuenta
                </a>
            @endguest
        </div>
    </div>

    <!-- Categorías Principales (RF-06) -->
    <div id="catalogo" style="margin-bottom: 4rem;">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <h2 style="font-size: 1.5rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--gold-light); margin-bottom: 0.4rem;">
                Nuestras Categorías
            </h2>
            <p style="color: var(--text-muted); font-size: 0.85rem;">
                Piezas y fragancias seleccionadas bajo rigurosos estándares
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
            <!-- Relojes -->
            <div id="relojes" class="glass-card" style="padding: 2rem; text-align: center; border-color: rgba(212,175,55,0.3); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="width: 60px; height: 60px; margin: 0 auto 1.2rem auto; background: rgba(212,175,55,0.1); border: 1px solid var(--gold-border); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="7"></circle>
                            <polyline points="12 9 12 12 13.5 13.5"></polyline>
                            <path d="M16.51 17.35l-.35 3.83a2 2 0 0 1-2 1.82H9.83a2 2 0 0 1-2-1.82l-.35-3.83m.01-10.7l.35-3.83A2 2 0 0 1 9.83 1h4.35a2 2 0 0 1 2 1.82l.35 3.83"></path>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; letter-spacing: 1px; color: var(--gold-light); margin-bottom: 0.6rem;">Relojes</h3>
                    <p style="color: var(--text-muted); font-size: 0.85rem; line-height: 1.5; margin-bottom: 1.5rem;">
                        Modelos Originales, Alta Gama y Réplicas 1.1 con maquinarias automáticas y acabados de precisión.
                    </p>
                </div>
                <div>
                    <span style="font-size: 0.78rem; font-weight: 600; color: var(--gold); letter-spacing: 1px; text-transform: uppercase;">
                        Ver Catálogo &rarr;
                    </span>
                </div>
            </div>

            <!-- Perfumes -->
            <div id="perfumes" class="glass-card" style="padding: 2rem; text-align: center; border-color: rgba(212,175,55,0.3); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="width: 60px; height: 60px; margin: 0 auto 1.2rem auto; background: rgba(212,175,55,0.1); border: 1px solid var(--gold-border); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10 2h4"></path>
                            <path d="M12 2v4"></path>
                            <rect x="5" y="6" width="14" height="16" rx="3"></rect>
                            <circle cx="12" cy="14" r="3"></circle>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; letter-spacing: 1px; color: var(--gold-light); margin-bottom: 0.6rem;">Perfumes</h3>
                    <p style="color: var(--text-muted); font-size: 0.85rem; line-height: 1.5; margin-bottom: 1.5rem;">
                        Fragancias exclusivas para hombre y mujer en presentaciones originales y de alta concentración 1.1.
                    </p>
                </div>
                <div>
                    <span style="font-size: 0.78rem; font-weight: 600; color: var(--gold); letter-spacing: 1px; text-transform: uppercase;">
                        Ver Catálogo &rarr;
                    </span>
                </div>
            </div>

            <!-- Accesorios -->
            <div id="accesorios" class="glass-card" style="padding: 2rem; text-align: center; border-color: rgba(212,175,55,0.3); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="width: 60px; height: 60px; margin: 0 auto 1.2rem auto; background: rgba(212,175,55,0.1); border: 1px solid var(--gold-border); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; letter-spacing: 1px; color: var(--gold-light); margin-bottom: 0.6rem;">Accesorios</h3>
                    <p style="color: var(--text-muted); font-size: 0.85rem; line-height: 1.5; margin-bottom: 1.5rem;">
                        Billeteras en cuero legítimo, carrieles tradicionales, correas finas y gorras de lujo.
                    </p>
                </div>
                <div>
                    <span style="font-size: 0.78rem; font-weight: 600; color: var(--gold); letter-spacing: 1px; text-transform: uppercase;">
                        Ver Catálogo &rarr;
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
