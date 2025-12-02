<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-900">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Toko Gaming')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&family=Orbitron:wght@400;700;900&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'gaming-primary': '#ff6b35',
                        'gaming-secondary': '#1a1a2e',
                        'gaming-accent': '#16213e',
                        'gaming-dark': '#0f0f23',
                        'gaming-hover': '#ff8c42',
                        'gaming-text': '#e94560'
                    },
                    fontFamily: {
                        'rajdhani': ['Rajdhani', 'sans-serif'],
                        'orbitron': ['Orbitron', 'monospace']
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                        'pulse-glow': 'pulseGlow 2s ease-in-out infinite alternate'
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        pulseGlow: {
                            '0%': { boxShadow: '0 0 5px #ff6b35' },
                            '100%': { boxShadow: '0 0 20px #ff6b35, 0 0 30px #ff6b35' }
                        }
                    }
                }
            }
        }
    </script>

    <style>
        .bg-gaming-gradient {
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 100%);
        }

        .bg-gaming-card {
            background: linear-gradient(135deg, #16213e, #1a1a2e);
        }

        .text-shadow-glow {
            text-shadow: 0 0 10px rgba(255, 107, 53, 0.5);
        }

        .border-gaming-glow {
            border-color: #ff6b35;
            box-shadow: 0 0 10px rgba(255, 107, 53, 0.3);
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
        }

        .sidebar-link {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: rgba(255, 107, 53, 0.1);
            border-left-color: #ff6b35;
            transform: translateX(5px);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1a1a2e;
        }

        ::-webkit-scrollbar-thumb {
            background: #ff6b35;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #ff8c42;
        }
    </style>

    @stack('styles')
</head>

<body class="h-full bg-gaming-gradient font-rajdhani text-white">
    <!-- Header -->
    <nav class="bg-gaming-card border-b-4 border-gaming-primary shadow-2xl sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <!-- Mobile menu button -->
                    <button class="lg:hidden text-white hover:text-gaming-primary transition-colors duration-300 mr-4"
                        onclick="toggleSidebar()">
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <!-- Logo -->
                    <a href="{{ url('/') }}" class="flex items-center">
                        <i class="fas fa-gamepad text-gaming-primary text-2xl mr-3"></i>
                        <span class="font-orbitron font-black text-2xl text-gaming-primary text-shadow-glow">
                            GAME STORE
                        </span>
                    </a>
                </div>

                <!-- Right navigation -->
                <div class="flex items-center space-x-6">
                    <a href="#"
                        class="flex items-center text-white hover:text-gaming-primary transition-colors duration-300 hover-lift">
                        <i class="fas fa-user mr-2"></i>
                        <span class="hidden sm:block">Profile</span>
                    </a>
                    <a href="#"
                        class="flex items-center text-white hover:text-gaming-primary transition-colors duration-300 hover-lift">
                        <i class="fas fa-cog mr-2"></i>
                        <span class="hidden sm:block">Settings</span>
                    </a>
                    <a href="#"
                        class="flex items-center text-white hover:text-gaming-primary transition-colors duration-300 hover-lift">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        <span class="hidden sm:block">Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex h-screen pt-20">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 z-40 w-64 bg-gaming-card border-r-2 border-gaming-primary shadow-2xl transform -translate-x-full lg:translate-x-0 transition-transform duration-300 mt-20"
            id="sidebar">
            <!-- Sidebar header -->
            <div class="p-6 text-center border-b border-gaming-primary border-opacity-30">
                <h4 class="text-gaming-primary font-orbitron font-bold text-lg">
                    <i class="fas fa-crown mr-2"></i>
                    Admin Panel
                </h4>
            </div>

            <!-- Sidebar menu -->
            <nav class="mt-6">
                <div class="px-3 space-y-2">
                    <a href="{{ url('/dashboard') }}"
                        class="sidebar-link flex items-center px-4 py-3 text-white rounded-lg {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt w-5 text-center mr-3"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <a href="{{ url('/transaksi-manager') }}"
                        class="sidebar-link flex items-center px-4 py-3 text-white rounded-lg {{ request()->is('transaksi-manager') ? 'active' : '' }}">
                        <i class="fas fa-exchange-alt w-5 text-center mr-3"></i>
                        <span class="font-medium">Transaksi Manager</span>
                    </a>

                    <a href="{{ url('/produk') }}"
                        class="sidebar-link flex items-center px-4 py-3 text-white rounded-lg {{ request()->is('produk*') ? 'active' : '' }}">
                        <i class="fas fa-gamepad w-5 text-center mr-3"></i>
                        <span class="font-medium">Produk Game</span>
                    </a>

                    <a href="{{ url('/users') }}"
                        class="sidebar-link flex items-center px-4 py-3 text-white rounded-lg {{ request()->is('users*') ? 'active' : '' }}">
                        <i class="fas fa-users w-5 text-center mr-3"></i>
                        <span class="font-medium">Manajemen User</span>
                    </a>

                    <a href="{{ url('/laporan') }}"
                        class="sidebar-link flex items-center px-4 py-3 text-white rounded-lg {{ request()->is('laporan*') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar w-5 text-center mr-3"></i>
                        <span class="font-medium">Laporan</span>
                    </a>

                    <a href="{{ url('/voucher') }}"
                        class="sidebar-link flex items-center px-4 py-3 text-white rounded-lg {{ request()->is('voucher*') ? 'active' : '' }}">
                        <i class="fas fa-ticket-alt w-5 text-center mr-3"></i>
                        <span class="font-medium">Voucher & Promo</span>
                    </a>

                    <a href="{{ url('/settings') }}"
                        class="sidebar-link flex items-center px-4 py-3 text-white rounded-lg {{ request()->is('settings*') ? 'active' : '' }}">
                        <i class="fas fa-cogs w-5 text-center mr-3"></i>
                        <span class="font-medium">Pengaturan</span>
                    </a>
                </div>
            </nav>
        </div>

        <!-- Sidebar overlay for mobile -->
        <div class="fixed inset-0 z-30 bg-black bg-opacity-50 lg:hidden hidden" id="sidebar-overlay"
            onclick="toggleSidebar()"></div>

        <!-- Main content -->
        <div class="flex-1 lg:ml-64 overflow-auto">
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Toggle sidebar for mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Add fade-in animation to content
        document.addEventListener('DOMContentLoaded', function () {
            const elements = document.querySelectorAll('main > *');
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('animate-fade-in-up');
                }, index * 100);
            });
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function () {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Close mobile menu when resizing to desktop
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 1024) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>