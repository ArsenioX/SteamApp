@extends('layouts.user')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900">
        <!-- Header Section -->
        <div class="container mx-auto px-4 py-8">
            <div class="text-center mb-8">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">
                        🎮 Game Zone
                    </span>
                </h1>
                <p class="text-gray-300 text-lg">Nikmati pengalaman bermain game yang seru!</p>
            </div>

            <!-- Game Container -->
            <div class="max-w-7xl mx-auto">
                <div class="bg-white/10 backdrop-blur-md rounded-3xl p-6 md:p-8 shadow-2xl border border-white/20">
                    <!-- Game Title Bar -->
                    <div
                        class="flex items-center justify-between mb-6 p-4 bg-gradient-to-r from-purple-600 to-blue-600 rounded-2xl">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        </div>
                        <h2 class="text-white font-semibold text-lg capitalize">{{ str_replace('-', ' ', $slug) }}</h2>
                        <div class="flex items-center space-x-2">
                            <button onclick="toggleFullscreen()" class="text-white hover:text-gray-300 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Game Frame -->
                    <div class="game-container relative rounded-2xl overflow-hidden shadow-2xl">
                        <div class="aspect-video bg-gray-900 flex items-center justify-center">
                            <iframe id="gameFrame" src="{{ asset('games/' . $slug . '/index.html') }}"
                                class="w-full h-full border-0 rounded-2xl" style="min-height: 500px;"
                                allow="fullscreen; autoplay; encrypted-media" loading="lazy">
                                <div class="flex flex-col items-center justify-center h-full text-white">
                                    <svg class="w-16 h-16 mb-4 text-red-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z">
                                        </path>
                                    </svg>
                                    <p class="text-lg font-semibold mb-2">Browser Tidak Mendukung</p>
                                    <p class="text-gray-400">Browser Anda tidak mendukung iframe atau game tidak dapat
                                        dimuat.</p>
                                </div>
                            </iframe>
                        </div>
                    </div>

                    <!-- Game Controls -->
                    <div class="mt-6 flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center space-x-4">
                            <button onclick="reloadGame()"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                <span>Reload</span>
                            </button>
                         
                                class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                <span>Kembali ke Library</span>
                            </a>
                        </div>

                        <div class="flex items-center space-x-2 text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span class="text-sm">Tekan F11 untuk fullscreen</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 flex items-center space-x-4">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-purple-600"></div>
            <span class="text-gray-700">Memuat game...</span>
        </div>
    </div>

    <style>
        .game-container {
            position: relative;
            background: linear-gradient(45deg, #1a1a2e, #16213e, #0f3460);
        }

        .game-container::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #ffeaa7);
            border-radius: 1rem;
            z-index: -1;
            animation: borderGlow 3s ease-in-out infinite alternate;
        }

        @keyframes borderGlow {
            0% {
                opacity: 0.5;
            }

            100% {
                opacity: 0.8;
            }
        }

        /* Responsive iframe */
        @media (max-width: 768px) {
            .game-container iframe {
                min-height: 400px;
            }
        }

        @media (max-width: 480px) {
            .game-container iframe {
                min-height: 300px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const iframe = document.getElementById('gameFrame');
            const loadingOverlay = document.getElementById('loadingOverlay');

            // Show loading overlay
            loadingOverlay.classList.remove('hidden');

            // Hide loading overlay when iframe loads
            iframe.addEventListener('load', function () {
                setTimeout(() => {
                    loadingOverlay.classList.add('hidden');
                }, 500);
            });

            // Handle iframe load error
            iframe.addEventListener('error', function () {
                loadingOverlay.classList.add('hidden');
                console.error('Failed to load game');
            });
        });

        function reloadGame() {
            const iframe = document.getElementById('gameFrame');
            const loadingOverlay = document.getElementById('loadingOverlay');

            loadingOverlay.classList.remove('hidden');
            iframe.src = iframe.src;

            setTimeout(() => {
                loadingOverlay.classList.add('hidden');
            }, 1000);
        }

        function toggleFullscreen() {
            const gameContainer = document.querySelector('.game-container');

            if (!document.fullscreenElement) {
                gameContainer.requestFullscreen().catch(err => {
                    console.error('Error attempting to enable fullscreen:', err);
                });
            } else {
                document.exitFullscreen();
            }
        }

        // Handle fullscreen changes
        document.addEventListener('fullscreenchange', function () {
            const iframe = document.getElementById('gameFrame');
            if (document.fullscreenElement) {
                iframe.style.height = '100vh';
            } else {
                iframe.style.height = '';
            }
        });

        // Add keyboard shortcuts
        document.addEventListener('keydown', function (e) {
            // F5 or Ctrl+R to reload game
            if (e.key === 'F5' || (e.ctrlKey && e.key === 'r')) {
                e.preventDefault();
                reloadGame();
            }

            // Escape to exit fullscreen
            if (e.key === 'Escape' && document.fullscreenElement) {
                document.exitFullscreen();
            }
        });
    </script>
@endsection