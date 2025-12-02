<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ShopGaming') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'gaming-dark': '#2d3748',
                        'gaming-darker': '#1a202c',
                        'gaming-purple': '#9f7aea',
                        'gaming-blue': '#4299e1',
                        'gaming-card': '#4a5568',
                        'gaming-hover': '#718096',
                    },
                    fontFamily: {
                        sans: ['Figtree', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        .bg-gaming-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-gaming {
            background: linear-gradient(135deg, #9f7aea 0%, #667eea 100%);
            transition: all 0.3s ease;
        }

        .btn-gaming:hover {
            background: linear-gradient(135deg, #805ad5 0%, #5a67d8 100%);
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(159, 122, 234, 0.3);
        }

        .btn-gaming-blue {
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
            transition: all 0.3s ease;
        }

        .btn-gaming-blue:hover {
            background: linear-gradient(135deg, #3182ce 0%, #2c5282 100%);
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(66, 153, 225, 0.3);
        }
    </style>
</head>

<body class="bg-gaming-darker text-white">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass-effect">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <i class="fas fa-gamepad text-2xl text-gaming-purple"></i>
                    <h1 class="text-xl font-bold text-white">ShopGaming</h1>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors">Home</a>
                    <a href="{{ route('transaksi.cart') }}"
                        class="text-gray-300 hover:text-white transition-colors">Cart</a>
                    <a href="{{ route('transaksi.library') }}"
                        class="text-gray-300 hover:text-white transition-colors">Library</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-3">
                    @guest
                        <a href="{{ route('login') }}" class="px-4 py-2 btn-gaming text-white rounded-lg">Login</a>
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 btn-gaming-blue text-white rounded-lg">Register</a>
                    @else
                        <!-- User Dropdown -->
                        <div class="relative group">
                            <button
                                class="flex items-center space-x-2 text-white hover:text-gaming-purple transition-colors">
                                <i class="fas fa-user"></i>
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-sm"></i>
                            </button>
                            <!-- Dropdown Menu -->
                            <div
                                class="absolute right-0 mt-2 w-48 bg-gaming-card rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
                                <a href="#" class="block px-4 py-2 text-gray-300 hover:text-white">Profile</a>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="block px-4 py-2 text-gray-300 hover:text-white">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gaming-dark mt-16 py-12">
        <div class="max-w-7xl mx-auto text-center text-gray-400">
            <i class="fas fa-gamepad text-2xl text-gaming-purple mb-4"></i>
            <p>Temukan & beli game favoritmu dengan harga terbaik</p>
            <p class="text-sm mt-4">&copy; {{ date('Y') }} ShopGaming. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>