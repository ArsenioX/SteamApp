@extends('layouts.user')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-gray-900">
        <div class="container mx-auto px-4 py-8">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1
                    class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-400 to-cyan-400 mb-4">
                    🎮 Library Game Kamu
                </h1>
                <div class="h-1 w-32 bg-gradient-to-r from-purple-500 to-pink-500 mx-auto rounded-full"></div>
            </div>

            <!-- Games Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($transaksis as $item)
                    <div class="group">
                        <div
                            class="bg-gray-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl p-6 shadow-2xl hover:shadow-purple-500/25 transition-all duration-300 hover:scale-105 hover:bg-gray-800/70">
                            <!-- Game Image -->
                            <div
                                class="w-full h-48 bg-gray-700 rounded-lg mb-4 flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('storage/' . $item->produk->gambar) }}" alt="{{ $item->produk->nama }}"
                                    class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-300">
                            </div>

                            <!-- Game Title -->
                            <h5
                                class="text-xl font-bold text-white mb-6 group-hover:text-purple-300 transition-colors duration-300">
                                {{ $item->produk->nama }}
                            </h5>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-2">
                                <!-- Play Button -->
                                <a href="{{ route('user.library.play', $item->id) }}"
                                    class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 text-center shadow-lg hover:shadow-green-500/25 transform hover:-translate-y-0.5">
                                    ▶️ Mainkan
                                </a>

                                <!-- Download Button -->
                                <a href="{{ route('user.library.download', $item->id) }}"
                                    class="flex-1 bg-gradient-to-r from-blue-500 to-cyan-600 hover:from-blue-600 hover:to-cyan-700 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 text-center shadow-lg hover:shadow-blue-500/25 transform hover:-translate-y-0.5">
                                    ⬇️ Download
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('user.library.delete', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus game ini dari library?');" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 shadow-lg hover:shadow-red-500/25 transform hover:-translate-y-0.5">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="col-span-full">
                        <div class="text-center py-16">
                            <div class="text-6xl mb-6">🎮</div>
                            <h3 class="text-2xl font-bold text-white mb-4">Library Masih Kosong</h3>
                            <p class="text-gray-400 text-lg mb-8">Kamu belum memiliki game yang dapat dimainkan atau didownload.
                            </p>
                            <div
                                class="inline-block bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold py-3 px-8 rounded-full shadow-lg">
                                Mulai koleksi game sekarang! 🚀
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection