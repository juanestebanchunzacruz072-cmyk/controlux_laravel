<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Controlux') | Exclusividad & Lujo</title>

    <!-- Google Fonts: Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <!-- Estilos base Controlux (Tema Blanco de Lujo) -->
    <style>
        :root {
            --bg-main: #FFFFFF;
            --bg-surface: #F9F9FB;
            --bg-card: #FFFFFF;
            --bg-card-hover: #FFFFFF;
            --gold: #B8860B;
            --gold-light: #8A6D15;
            --gold-dark: #66500F;
            --gold-gradient: linear-gradient(135deg, #D4AF37 0%, #AA771C 100%);
            --gold-border: rgba(184, 134, 11, 0.24);
            --gold-border-focus: rgba(184, 134, 11, 0.85);
            --text-main: #141416;
            --text-muted: #65676B;
            --text-gold: #997D20;
            --danger: #D32F2F;
            --success: #1E8E3E;
            --glass-blur: blur(14px);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            background-image: 
                radial-gradient(circle at 12% 15%, rgba(212, 175, 55, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 88% 85%, rgba(212, 175, 55, 0.04) 0%, transparent 45%);
            background-attachment: fixed;
        }

        a {
            color: inherit;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        /* Navbar */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border-bottom: 1px solid var(--gold-border);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 1.4rem;
            font-weight: 800;
            letter-spacing: 4px;
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-transform: uppercase;
        }

        .nav-brand svg {
            color: var(--gold);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }

        .nav-link {
            font-size: 0.88rem;
            font-weight: 600;
            letter-spacing: 1px;
            color: var(--text-muted);
            text-transform: uppercase;
            position: relative;
            padding: 0.3rem 0;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--gold-dark);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 2px;
            background: var(--gold-gradient);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* Buttons */
        .btn-gold {
            background: var(--gold-gradient);
            color: #FFFFFF;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 0.65rem 1.4rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 4px 15px rgba(184, 134, 11, 0.25);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 22px rgba(184, 134, 11, 0.4);
            filter: brightness(1.05);
            color: #FFFFFF;
        }

        .btn-outline-gold {
            background: transparent;
            color: var(--gold-dark);
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 0.6rem 1.3rem;
            border-radius: 6px;
            border: 1px solid var(--gold-border);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.25s ease;
        }

        .btn-outline-gold:hover {
            border-color: var(--gold);
            background: rgba(212, 175, 55, 0.08);
            color: var(--gold-dark);
            transform: translateY(-1px);
        }

        /* User Dropdown */
        .user-menu {
            position: relative;
        }

        .user-btn {
            background: rgba(0, 0, 0, 0.03);
            border: 1px solid var(--gold-border);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            color: var(--text-main);
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .user-btn:hover {
            border-color: var(--gold);
            background: rgba(212, 175, 55, 0.08);
        }

        .user-dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 0.6rem);
            background: #FFFFFF;
            border: 1px solid var(--gold-border);
            border-radius: 10px;
            min-width: 220px;
            padding: 0.5rem 0;
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.12);
            backdrop-filter: var(--glass-blur);
            display: none;
            flex-direction: column;
            z-index: 1000;
        }

        .user-dropdown.show {
            display: flex;
            animation: fadeIn 0.2s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dropdown-item {
            padding: 0.7rem 1.2rem;
            font-size: 0.85rem;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 0.7rem;
            transition: background 0.2s ease;
            cursor: pointer;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            font-family: inherit;
        }

        .dropdown-item:hover {
            background: rgba(212, 175, 55, 0.08);
            color: var(--gold-dark);
        }

        .dropdown-divider {
            height: 1px;
            background: rgba(0, 0, 0, 0.06);
            margin: 0.4rem 0;
        }

        /* Alerts */
        .alert-container {
            max-width: 1200px;
            margin: 1.5rem auto 0 auto;
            padding: 0 1.5rem;
            width: 100%;
        }

        .alert {
            padding: 1rem 1.4rem;
            border-radius: 8px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            margin-bottom: 1rem;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-success {
            background: rgba(30, 142, 62, 0.08);
            border: 1px solid rgba(30, 142, 62, 0.3);
            color: #1E8E3E;
        }

        .alert-error {
            background: rgba(211, 47, 47, 0.08);
            border: 1px solid rgba(211, 47, 47, 0.3);
            color: #D32F2F;
        }

        .alert-info {
            background: rgba(184, 134, 11, 0.08);
            border: 1px solid var(--gold-border);
            color: var(--gold-dark);
        }

        /* Main Content */
        main {
            flex: 1;
            padding: 2.5rem 1.5rem;
            max-width: 1280px;
            width: 100%;
            margin: 0 auto;
        }

        /* Footer */
        .footer {
            border-top: 1px solid rgba(184, 134, 11, 0.16);
            background: #F9F9FB;
            padding: 3rem 2rem 1.5rem;
            margin-top: auto;
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .footer-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2.5rem;
            margin-bottom: 2.5rem;
        }

        .footer-col h4 {
            color: var(--gold-dark);
            font-size: 0.95rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col li {
            margin-bottom: 0.5rem;
        }

        .footer-col a:hover {
            color: var(--gold-dark);
            padding-left: 4px;
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        /* Glassmorphism / Luxury White Card */
        .glass-card {
            background: var(--bg-card);
            border: 1px solid var(--gold-border);
            border-radius: 14px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            box-shadow: 0 14px 38px rgba(184, 134, 11, 0.1);
        }

        /* Form Inputs */
        .form-group {
            margin-bottom: 1.4rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.45rem;
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 0.8px;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1.1rem;
            background: #FFFFFF;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            color: var(--text-main);
            font-family: inherit;
            font-size: 0.95rem;
            transition: all 0.25s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--gold);
            background: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(184, 134, 11, 0.16);
        }

        .form-control::placeholder {
            color: #9E9E9E;
        }

        .form-error {
            color: var(--danger);
            font-size: 0.78rem;
            margin-top: 0.35rem;
            display: block;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
                flex-wrap: wrap;
            }
            .nav-links {
                display: none;
            }
            main {
                padding: 1.5rem 1rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Header / Navbar -->
    <header class="navbar">
        <a href="{{ route('home') }}" class="nav-brand" style="display: flex; align-items: center; gap: 0.75rem;">
            @if(file_exists(public_path('images/logo.png')))
                <img src="{{ asset('images/logo.png') }}" alt="JC Urban Controlux" style="height: 38px; width: 38px; border-radius: 8px; object-fit: cover; box-shadow: 0 3px 10px rgba(0,0,0,0.12); border: 1px solid var(--gold-border);">
            @elseif(file_exists(public_path('images/logo.svg')))
                <img src="{{ asset('images/logo.svg') }}" alt="JC Urban Controlux" style="height: 38px; width: 38px; border-radius: 8px; object-fit: cover; box-shadow: 0 3px 10px rgba(0,0,0,0.12); border: 1px solid var(--gold-border);">
            @else
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="7"></circle>
                    <polyline points="12 9 12 12 13.5 13.5"></polyline>
                    <path d="M16.51 17.35l-.35 3.83a2 2 0 0 1-2 1.82H9.83a2 2 0 0 1-2-1.82l-.35-3.83m.01-10.7l.35-3.83A2 2 0 0 1 9.83 1h4.35a2 2 0 0 1 2 1.82l.35 3.83"></path>
                </svg>
            @endif
            <span>Controlux</span>
        </a>

        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Inicio</a></li>
            <li><a href="{{ route('home') }}#relojes" class="nav-link">Relojes</a></li>
            <li><a href="{{ route('home') }}#perfumes" class="nav-link">Perfumes</a></li>
            <li><a href="{{ route('home') }}#accesorios" class="nav-link">Accesorios</a></li>
        </ul>

        <div class="nav-actions">
            @auth
                <div class="user-menu" id="userMenu">
                    <button type="button" class="user-btn" id="userMenuBtn" aria-label="Menú de usuario">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span>{{ Auth::user()->nombre }}</span>
                        @if(Auth::user()->isAdmin())
                            <span style="font-size: 0.68rem; background: var(--gold-gradient); color: #FFFFFF; padding: 2px 6px; border-radius: 4px; font-weight: 700;">ADMIN</span>
                        @endif
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>

                    <div class="user-dropdown" id="userDropdown">
                        <div style="padding: 0.6rem 1.2rem; font-size: 0.75rem; color: var(--text-muted); border-bottom: 1px solid rgba(0,0,0,0.06);">
                            Conectado como<br>
                            <strong style="color: var(--text-main);">{{ Auth::user()->correo }}</strong>
                        </div>
                        <a href="{{ route('perfil') }}" class="dropdown-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            Mi Perfil & Envíos
                        </a>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item" style="color: var(--gold-dark); font-weight: 600;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                                Panel Administrativo
                            </a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="dropdown-item" style="color: var(--danger);">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-outline-gold">Iniciar Sesión</a>
                <a href="{{ route('registro') }}" class="btn-gold">Registrarse</a>
            @endauth
        </div>
    </header>

    <!-- Flash Alerts -->
    <div class="alert-container">
        @if (session('success'))
            <div class="alert alert-success">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12.01" y2="16"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                <span>{{ session('info') }}</span>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-grid">
            <div class="footer-col">
                <h4>Controlux</h4>
                <p style="line-height: 1.6; color: var(--text-muted);">
                    Exclusividad, precisión y elegancia. Relojes, perfumes y accesorios importados seleccionados para quienes aprecian la distinción.
                </p>
            </div>
            <div class="footer-col">
                <h4>Colecciones</h4>
                <ul>
                    <li><a href="{{ route('home') }}#relojes">Relojes de Alta Gama</a></li>
                    <li><a href="{{ route('home') }}#perfumes">Perfumería Exclusiva</a></li>
                    <li><a href="{{ route('home') }}#accesorios">Accesorios & Marroquinería</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Atención al Cliente</h4>
                <ul>
                    <li><a href="{{ route('perfil') }}">Mi Cuenta & Envíos</a></li>
                    <li><a href="https://wa.me/573132047806" target="_blank" rel="noopener">Línea WhatsApp de Ventas</a></li>
                    <li><a href="#">Términos & Garantías</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div>&copy; {{ date('Y') }} Controlux (JC URBAN). Todos los derechos reservados.</div>
            <div style="color: var(--gold-dark); font-weight: 600;">Calidad y Garantía Certificada</div>
        </div>
    </footer>

    <!-- Script del Menú de Usuario -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('userMenuBtn');
            const dropdown = document.getElementById('userDropdown');

            if (btn && dropdown) {
                btn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('show');
                });

                document.addEventListener('click', function (e) {
                    if (!dropdown.contains(e.target)) {
                        dropdown.classList.remove('show');
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
