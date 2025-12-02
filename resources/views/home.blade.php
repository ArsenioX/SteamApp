@extends('layouts.user')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gaming-hero min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-8 animate-fade-in">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">
                    "Selamat Datang di ShopGaming"
                </h1>
                <p class="text-xl md:text-2xl text-gray-300 mb-8">
                    "Temukan & beli game favoritmu dengan harga terbaik"
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#games-section" class="px-8 py-3 btn-gaming text-white rounded-lg font-medium hover-lift transition-all duration-300">
                        <i class="fas fa-shopping-bag mr-2"></i>Shop Now
                    </a>
                    <a href="#games-section" class="px-8 py-3 btn-gaming-blue text-white rounded-lg font-medium hover-lift transition-all duration-300">
                        <i class="fas fa-compass mr-2"></i>Explore Games
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Games Section -->
    <section id="games-section" class="py-16 bg-gaming-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2">Game Terpopuler</h2>
                    <p class="text-gray-400">Koleksi game terbaik dengan harga spesial</p>
                </div>
                <div class="flex gap-3 w-full sm:w-auto">
                    <a href="{{ route('transaksi.cart') }}" class="flex-1 sm:flex-none px-4 py-2 btn-gaming text-white rounded-lg font-medium hover-lift transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-shopping-cart mr-2"></i>Keranjang
                    </a>
                    <a href="{{ route('transaksi.library') }}" class="flex-1 sm:flex-none px-4 py-2 btn-gaming-blue text-white rounded-lg font-medium hover-lift transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-book mr-2"></i>Library
                    </a>
                </div>
            </div>

             {{-- Form Search dan Filter --}}
        <form method="GET" action="{{ route('home') }}" class="mb-6 flex flex-wrap items-center gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..."
                class="px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 placeholder-gray-400" />

            <select name="kategori" class="px-4 py-2 rounded bg-gray-700 text-white border border-gray-600">
                <option value="">Semua Kategori</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Cari
            </button>
        </form>

            @if($produks->isNotEmpty())
                <!-- Games Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($produks->take(6) as $produk)
                        <div class="bg-gaming-card rounded-lg overflow-hidden hover-lift glass-effect transform transition-all duration-300 hover:scale-105">
                            <!-- Game Image -->
                            <div class="relative h-48 bg-gaming-darker overflow-hidden">
                                @if($produk->gambar)
                                    <img src="{{ asset('storage/' . $produk->gambar) }}" 
                                         alt="{{ $produk->nama }}"
                                         class="w-full h-full object-cover transition-transform duration-300 hover:scale-110"
                                         loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gaming-purple to-gaming-blue">
                                        <i class="fas fa-gamepad text-4xl text-white opacity-50"></i>
                                    </div>
                                @endif
                                
                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                                
                                <!-- Platform Badge -->
                                <div class="absolute top-3 left-3">
                                    <span class="px-2 py-1 bg-black bg-opacity-80 backdrop-blur-sm text-white text-xs rounded-full flex items-center">
                                        @switch($produk->platform)
                                            @case('Steam')
                                                <i class="fab fa-steam mr-1"></i>
                                                @break
                                            @case('Epic Games')
                                                <i class="fas fa-gamepad mr-1"></i>
                                                @break
                                            @case('PlayStation')
                                                <i class="fab fa-playstation mr-1"></i>
                                                @break
                                            @case('Xbox')
                                                <i class="fab fa-xbox mr-1"></i>
                                                @break
                                            @default
                                                <i class="fas fa-desktop mr-1"></i>
                                        @endswitch
                                        {{ $produk->platform }}
                                    </span>
                                </div>

                                <!-- Stock Badge -->
                                <div class="absolute top-3 right-3">
                                    @if($produk->stok > 10)
                                        <span class="px-2 py-1 bg-green-600 bg-opacity-90 backdrop-blur-sm text-white text-xs rounded-full">
                                            <i class="fas fa-check mr-1"></i>In Stock
                                        </span>
                                    @elseif($produk->stok > 0)
                                        <span class="px-2 py-1 bg-yellow-600 bg-opacity-90 backdrop-blur-sm text-white text-xs rounded-full">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>Low Stock
                                        </span>
                                    @else
                                        <span class="px-2 py-1 bg-red-600 bg-opacity-90 backdrop-blur-sm text-white text-xs rounded-full">
                                            <i class="fas fa-times mr-1"></i>Out of Stock
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Game Info -->
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-lg font-bold text-white mb-1 line-clamp-2">{{ $produk->nama }}</h3>
                                    <span class="text-xs bg-gaming-purple px-2 py-1 rounded text-white whitespace-nowrap ml-2">
                                        {{ $produk->kode_produk }}
                                    </span>
                                </div>
                                
                                <p class="text-gray-400 text-sm mb-3">
                                    <i class="fas fa-tag mr-1"></i>{{ $produk->kategori->nama ?? 'Uncategorized' }}
                                </p>

                                <div class="flex justify-between items-center mb-4">
                                    <div class="text-2xl font-bold text-gaming-purple">
                                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                    </div>
                                    <div class="text-sm text-gray-400">
                                        <i class="fas fa-boxes mr-1"></i>{{ $produk->stok }} tersisa
                                    </div>
                                </div>

                                <!-- Action Button -->
                                @if($produk->stok > 0)
                                    <form action="{{ route('transaksi.beli') }}" method="POST" class="add-to-cart-form">
                                        @csrf
                                        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                        <button type="submit" class="w-full px-4 py-3 bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white rounded-lg font-medium hover-lift transition-all duration-300 transform hover:scale-105 active:scale-95">
                                            <i class="fas fa-cart-plus mr-2"></i>Tambah ke Keranjang
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="w-full px-4 py-3 bg-gray-600 text-gray-400 rounded-lg font-medium cursor-not-allowed">
                                        <i class="fas fa-ban mr-2"></i>Stok Habis
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- View All Button -->
                @if($produks->count() > 6)
                    <div class="text-center">
                        <button id="load-more" class="px-8 py-3 btn-gaming-blue text-white rounded-lg font-medium hover-lift transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-eye mr-2"></i>Lihat Semua Game
                        </button>
                    </div>

                    <!-- Hidden Games (Load More) -->
                    <div id="more-games" class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                        @foreach($produks->skip(6) as $produk)
                            <div class="bg-gaming-card rounded-lg overflow-hidden hover-lift glass-effect transform transition-all duration-300 hover:scale-105">
                                <!-- Game Image -->
                                <div class="relative h-48 bg-gaming-darker overflow-hidden">
                                    @if($produk->gambar)
                                        <img src="{{ asset('storage/' . $produk->gambar) }}" 
                                             alt="{{ $produk->nama }}"
                                             class="w-full h-full object-cover transition-transform duration-300 hover:scale-110"
                                             loading="lazy">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gaming-purple to-gaming-blue">
                                            <i class="fas fa-gamepad text-4xl text-white opacity-50"></i>
                                        </div>
                                    @endif
                                    
                                    <!-- Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                                    
                                    <!-- Platform Badge -->
                                    <div class="absolute top-3 left-3">
                                        <span class="px-2 py-1 bg-black bg-opacity-80 backdrop-blur-sm text-white text-xs rounded-full flex items-center">
                                            @switch($produk->platform)
                                                @case('Steam')
                                                    <i class="fab fa-steam mr-1"></i>
                                                    @break
                                                @case('Epic Games')
                                                    <i class="fas fa-gamepad mr-1"></i>
                                                    @break
                                                @case('PlayStation')
                                                    <i class="fab fa-playstation mr-1"></i>
                                                    @break
                                                @case('Xbox')
                                                    <i class="fab fa-xbox mr-1"></i>
                                                    @break
                                                @default
                                                    <i class="fas fa-desktop mr-1"></i>
                                            @endswitch
                                            {{ $produk->platform }}
                                        </span>
                                    </div>

                                    <!-- Stock Badge -->
                                    <div class="absolute top-3 right-3">
                                        @if($produk->stok > 10)
                                            <span class="px-2 py-1 bg-green-600 bg-opacity-90 backdrop-blur-sm text-white text-xs rounded-full">
                                                <i class="fas fa-check mr-1"></i>In Stock
                                            </span>
                                        @elseif($produk->stok > 0)
                                            <span class="px-2 py-1 bg-yellow-600 bg-opacity-90 backdrop-blur-sm text-white text-xs rounded-full">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>Low Stock
                                            </span>
                                        @else
                                            <span class="px-2 py-1 bg-red-600 bg-opacity-90 backdrop-blur-sm text-white text-xs rounded-full">
                                                <i class="fas fa-times mr-1"></i>Out of Stock
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Game Info -->
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="text-lg font-bold text-white mb-1 line-clamp-2">{{ $produk->nama }}</h3>
                                        <span class="text-xs bg-gaming-purple px-2 py-1 rounded text-white whitespace-nowrap ml-2">
                                            {{ $produk->kode_produk }}
                                        </span>
                                    </div>
                                    
                                    <p class="text-gray-400 text-sm mb-3">
                                        <i class="fas fa-tag mr-1"></i>{{ $produk->kategori->nama ?? 'Uncategorized' }}
                                    </p>

                                    <div class="flex justify-between items-center mb-4">
                                        <div class="text-2xl font-bold text-gaming-purple">
                                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                        </div>
                                        <div class="text-sm text-gray-400">
                                            <i class="fas fa-boxes mr-1"></i>{{ $produk->stok }} tersisa
                                        </div>
                                    </div>

                                    <!-- Action Button -->
                                    @if($produk->stok > 0)
                                        <form action="{{ route('transaksi.beli') }}" method="POST" class="add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                            <button type="submit" class="w-full px-4 py-3 bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white rounded-lg font-medium hover-lift transition-all duration-300 transform hover:scale-105 active:scale-95">
                                                <i class="fas fa-cart-plus mr-2"></i>Tambah ke Keranjang
                                            </button>
                                        </form>
                                    @else
                                        <button disabled class="w-full px-4 py-3 bg-gray-600 text-gray-400 rounded-lg font-medium cursor-not-allowed">
                                            <i class="fas fa-ban mr-2"></i>Stok Habis
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="mb-8 animate-bounce">
                        <i class="fas fa-gamepad text-6xl text-gaming-purple opacity-50"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Belum Ada Game Tersedia</h3>
                    <p class="text-gray-400 mb-8">Kembali lagi nanti untuk rilis terbaru dan update game!</p>
                    <a href="#" class="px-6 py-3 btn-gaming text-white rounded-lg font-medium hover-lift transition-all duration-300">
                        <i class="fas fa-bell mr-2"></i>Beri Tahu Saya
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Toast Notifications -->
    @if(session('success'))
        <div id="success-toast" class="fixed top-24 right-4 z-50 glass-effect rounded-lg p-4 text-white max-w-sm transform translate-x-0 transition-transform duration-300">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">Berhasil!</p>
                    <p class="text-sm text-gray-300">{{ session('success') }}</p>
                </div>
                <button onclick="closeToast('success-toast')" class="ml-4 text-gray-400 hover:text-white transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div id="error-toast" class="fixed top-24 right-4 z-50 glass-effect rounded-lg p-4 text-white max-w-sm transform translate-x-0 transition-transform duration-300">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">Error!</p>
                    <p class="text-sm text-gray-300">{{ session('error') }}</p>
                </div>
                <button onclick="closeToast('error-toast')" class="ml-4 text-gray-400 hover:text-white transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif
@endsection

@push('styles')
<style>
    .animate-fade-in {
        animation: fadeIn 1s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }
    
    .glass-effect {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Load more games functionality
        const loadMoreBtn = document.getElementById('load-more');
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                const moreGames = document.getElementById('more-games');
                const button = this;
                
                // Show more games with animation
                moreGames.classList.remove('hidden');
                button.style.display = 'none';
                
                // Animate the new games
                const newGameCards = moreGames.querySelectorAll('.hover-lift');
                newGameCards.forEach((card, index) => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(30px)';
                    setTimeout(() => {
                        card.style.transition = 'all 0.6s ease';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 100);
                });
            });
        }

        // Toast notification functions
        window.closeToast = function(toastId) {
            const toast = document.getElementById(toastId);
            if (toast) {
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => toast.remove(), 300);
            }
        }

        // Auto-hide toasts after 5 seconds
        const toasts = document.querySelectorAll('[id$="-toast"]');
        toasts.forEach(toast => {
            setTimeout(() => {
                closeToast(toast.id);
            }, 5000);
        });

        // Smooth scroll to games section
        document.querySelectorAll('a[href="#games-section"]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.getElementById('games-section');
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Enhanced add to cart interaction (no loading animation)
        document.querySelectorAll('.add-to-cart-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const button = this.querySelector('button[type="submit"]');
                
                // Quick visual feedback without loading state
                button.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    button.style.transform = '';
                }, 150);
            });
        });

        // Add scroll reveal animation for game cards
        const observeElements = document.querySelectorAll('.hover-lift');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        observeElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease';
            observer.observe(el);
        });
    });
</script>
@endpush