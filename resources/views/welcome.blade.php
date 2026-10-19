@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div style="padding: 2rem 0;">
    <!-- Hero Banner Exclusivo -->
    <div class="glass-card" style="text-align: center; padding: 4.5rem 2rem; position: relative; overflow: hidden; margin-bottom: 3.5rem; background: linear-gradient(180deg, #FFFFFF 0%, #FAFAFC 100%);">
        <div style="position: absolute; top: -100px; left: 50%; transform: translateX(-50%); width: 400px; height: 300px; background: radial-gradient(circle, rgba(212,175,55,0.1) 0%, transparent 70%); pointer-events: none;"></div>

        <span style="display: inline-block; font-size: 0.78rem; font-weight: 700; letter-spacing: 3px; color: var(--gold-dark); text-transform: uppercase; margin-bottom: 1rem; border: 1px solid var(--gold-border); padding: 5px 16px; border-radius: 50px; background: rgba(184,134,11,0.06);">
            Colección Exclusiva 2026
        </span>

        <h1 style="font-size: clamp(2.2rem, 5vw, 3.8rem); font-weight: 800; letter-spacing: 3px; text-transform: uppercase; line-height: 1.15; margin-bottom: 1.2rem; color: var(--text-main);">
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
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 2rem;">
            <!-- Relojes -->
            <div id="relojes" class="glass-card" style="padding: 1.5rem; text-align: center; display: flex; flex-direction: column; justify-content: space-between; overflow: hidden;">
                <div>
                    <div style="height: 220px; margin: -1.5rem -1.5rem 1.2rem -1.5rem; overflow: hidden; background: #FFFFFF; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid var(--gold-border); padding: 1.2rem; box-sizing: border-box;">
                        <img src="{{ asset('images/reloj.webp') }}?v=2" alt="Relojes de Lujo" style="max-width: 90%; max-height: 90%; width: auto; height: auto; object-fit: contain; object-position: center; filter: drop-shadow(0 10px 18px rgba(0,0,0,0.08)); transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), filter 0.4s ease;" onmouseover="this.style.transform='scale(1.08) translateY(-4px)'; this.style.filter='drop-shadow(0 16px 26px rgba(212, 175, 55, 0.25))'" onmouseout="this.style.transform='scale(1)'; this.style.filter='drop-shadow(0 10px 18px rgba(0,0,0,0.08))'">
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; letter-spacing: 1px; color: var(--text-main); margin-bottom: 0.6rem;">Relojes</h3>
                    <p style="color: var(--text-muted); font-size: 0.85rem; line-height: 1.5; margin-bottom: 1.5rem;">
                        Modelos Originales, Alta Gama y Réplicas 1.1 con maquinarias automáticas y acabados de precisión.
                    </p>
                </div>
                <div>
                    <span style="font-size: 0.78rem; font-weight: 700; color: var(--gold-dark); letter-spacing: 1px; text-transform: uppercase;">
                        Ver Catálogo &rarr;
                    </span>
                </div>
            </div>

            <!-- Perfumes -->
            <div id="perfumes" class="glass-card" style="padding: 1.5rem; text-align: center; display: flex; flex-direction: column; justify-content: space-between; overflow: hidden;">
                <div>
                    <div style="height: 220px; margin: -1.5rem -1.5rem 1.2rem -1.5rem; overflow: hidden; background: #FFFFFF; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid var(--gold-border); padding: 1.2rem; box-sizing: border-box;">
                        <img src="{{ asset('images/perfume.webp') }}?v=2" alt="Perfumes Exclusivos" style="max-width: 90%; max-height: 90%; width: auto; height: auto; object-fit: contain; object-position: center; filter: drop-shadow(0 10px 18px rgba(0,0,0,0.08)); transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), filter 0.4s ease;" onmouseover="this.style.transform='scale(1.08) translateY(-4px)'; this.style.filter='drop-shadow(0 16px 26px rgba(212, 175, 55, 0.25))'" onmouseout="this.style.transform='scale(1)'; this.style.filter='drop-shadow(0 10px 18px rgba(0,0,0,0.08))'">
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; letter-spacing: 1px; color: var(--text-main); margin-bottom: 0.6rem;">Perfumes</h3>
                    <p style="color: var(--text-muted); font-size: 0.85rem; line-height: 1.5; margin-bottom: 1.5rem;">
                        Fragancias exclusivas para hombre y mujer en presentaciones originales y de alta concentración 1.1.
                    </p>
                </div>
                <div>
                    <span style="font-size: 0.78rem; font-weight: 700; color: var(--gold-dark); letter-spacing: 1px; text-transform: uppercase;">
                        Ver Catálogo &rarr;
                    </span>
                </div>
            </div>

            <!-- Accesorios -->
            <div id="accesorios" class="glass-card" style="padding: 1.5rem; text-align: center; display: flex; flex-direction: column; justify-content: space-between; overflow: hidden;">
                <div>
                    <div style="height: 220px; margin: -1.5rem -1.5rem 1.2rem -1.5rem; overflow: hidden; background: #FFFFFF; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid var(--gold-border); padding: 1.2rem; box-sizing: border-box;">
                        <img src="{{ asset('images/accesorio.png') }}?v=2" alt="Accesorios de Lujo" style="max-width: 90%; max-height: 90%; width: auto; height: auto; object-fit: contain; object-position: center; filter: drop-shadow(0 10px 18px rgba(0,0,0,0.08)); transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), filter 0.4s ease;" onmouseover="this.style.transform='scale(1.08) translateY(-4px)'; this.style.filter='drop-shadow(0 16px 26px rgba(212, 175, 55, 0.25))'" onmouseout="this.style.transform='scale(1)'; this.style.filter='drop-shadow(0 10px 18px rgba(0,0,0,0.08))'">
                    </div>
                    <h3 style="font-size: 1.2rem; font-weight: 700; letter-spacing: 1px; color: var(--text-main); margin-bottom: 0.6rem;">Accesorios</h3>
                    <p style="color: var(--text-muted); font-size: 0.85rem; line-height: 1.5; margin-bottom: 1.5rem;">
                        Billeteras en cuero legítimo, carrieles tradicionales, correas finas y gorras de lujo.
                    </p>
                </div>
                <div>
                    <span style="font-size: 0.78rem; font-weight: 700; color: var(--gold-dark); letter-spacing: 1px; text-transform: uppercase;">
                        Ver Catálogo &rarr;
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
