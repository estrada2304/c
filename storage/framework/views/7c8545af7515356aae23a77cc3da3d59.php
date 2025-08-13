<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'ROTOPOOL - Gestión de Almacén')); ?></title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        :root {
            --kaitoke-green: #2ecc71;
            --kaitoke-dark: #27ae60;
            --white: #ffffff;
            --black: #2c3e50;
            --light-bg: #f8f9fa;
        }

        [data-theme="dark"] {
            --kaitoke-green: #27ae60;
            --white: #1a1a1a;
            --black: #f0f0f0;
            --light-bg: #2d3748;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--light-bg);
            color: var(--black);
        }

        .sidebar {
            background-color: var(--kaitoke-green);
            min-height: 100vh;
            color: white;
            width: 250px;
            position: fixed;
            transition: all 0.3s;
        }

        .sidebar .nav-link {
            color: white;
            padding: 12px 20px;
            margin: 2px 0;
            border-radius: 4px;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
        }

        .navbar {
            background-color: var(--white) !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .theme-toggle {
            cursor: pointer;
            margin-left: 15px;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
            }
            .sidebar.active {
                margin-left: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
</head>
<body>
    <div id="app">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="p-3 text-center">
                <h3 class="text-white">ROTOPOOL</h3>
                <hr class="bg-white">
            </div>
            <nav class="nav flex-column px-3">
                <a class="nav-link <?php echo e(Request::is('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
                <a class="nav-link <?php echo e(Request::is('inventory*') ? 'active' : ''); ?>" href="<?php echo e(route('inventory.index')); ?>">
                    <i class="bi bi-box-seam me-2"></i> Inventario
                </a>
                <a class="nav-link <?php echo e(Request::is('returns*') ? 'active' : ''); ?>" href="<?php echo e(route('returns.index')); ?>">
                    <i class="bi bi-arrow-return-left me-2"></i> Devoluciones
                </a>
                <a class="nav-link <?php echo e(Request::is('exports*') ? 'active' : ''); ?>" href="<?php echo e(route('exports.index')); ?>">
                    <i class="bi bi-box-arrow-up me-2"></i> Exportaciones
                </a>
                <a class="nav-link <?php echo e(Request::is('imports*') ? 'active' : ''); ?>" href="<?php echo e(route('imports.index')); ?>">
                    <i class="bi bi-box-arrow-in-down me-2"></i> Importaciones
                </a>
                <a class="nav-link <?php echo e(Request::is('clients*') ? 'active' : ''); ?>" href="<?php echo e(route('clients.index')); ?>">
                    <i class="bi bi-people me-2"></i> Clientes
                </a>
                <a class="nav-link <?php echo e(Request::is('history*') ? 'active' : ''); ?>" href="<?php echo e(route('history.index')); ?>">
                    <i class="bi bi-clock-history me-2"></i> Histórico
                </a>
                <a class="nav-link <?php echo e(Request::is('settings*') ? 'active' : ''); ?>" href="<?php echo e(route('settings.index')); ?>">
                    <i class="bi bi-gear me-2"></i> Configuraciones
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                <div class="container-fluid">
                    <button class="btn btn-sm d-md-none" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    
                    <div class="d-flex align-items-center ms-auto">
                        <span class="me-2">Modo Oscuro</span>
                        <label class="switch theme-toggle">
                            <input type="checkbox" id="themeToggle">
                            <span class="slider round"></span>
                        </label>
                        
                        <!-- User Dropdown -->
                        <div class="dropdown ms-3">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> <?php echo e(Auth::user()->name); ?>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Perfil</a></li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                    </a>
                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="py-4">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Dark/Light mode toggle
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;
        
        // Check for saved theme preference
        if (localStorage.getItem('theme') === 'dark') {
            html.setAttribute('data-theme', 'dark');
            themeToggle.checked = true;
        }
        
        themeToggle.addEventListener('change', function() {
            if (this.checked) {
                html.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            } else {
                html.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
            }
        });
    </script>
</body>
</html><?php /**PATH C:\Users\Professional Machine\rotopool-management\resources\views/layouts/app.blade.php ENDPATH**/ ?>