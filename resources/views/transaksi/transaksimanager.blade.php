@extends('layouts.gaming')

@section('title', 'Transaksi Manager - Toko Gaming')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="bg-gaming-card rounded-2xl border border-gaming-primary border-opacity-30 p-6 shadow-2xl">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-orbitron font-bold text-gaming-primary text-shadow-glow mb-2">
                        <i class="fas fa-exchange-alt mr-3"></i>
                        Transaksi Manager
                    </h1>
                    <p class="text-gray-300 text-lg">Kelola semua transaksi game store Anda</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('produk.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-gaming-primary hover:bg-gaming-hover text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                        <i class="fas fa-home mr-2"></i>
                        Beranda
                    </a>
                </div>
            </div>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div
                class="alert bg-green-500 bg-opacity-20 border border-green-500 text-green-300 px-6 py-4 rounded-xl flex items-center">
                <i class="fas fa-check-circle mr-3 text-xl"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div
                class="bg-gaming-card rounded-xl p-6 border border-gaming-primary border-opacity-30 hover:border-opacity-60 transition-all duration-300">
                <div class="flex items-center">
                    <div class="p-3 bg-gaming-primary bg-opacity-20 rounded-lg">
                        <i class="fas fa-shopping-cart text-gaming-primary text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-400 text-sm">Total Transaksi</p>
                        <p class="text-2xl font-bold text-white">{{ $transaksis->count() }}</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-gaming-card rounded-xl p-6 border border-green-500 border-opacity-30 hover:border-opacity-60 transition-all duration-300">
                <div class="flex items-center">
                    <div class="p-3 bg-green-500 bg-opacity-20 rounded-lg">
                        <i class="fas fa-check-circle text-green-400 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-400 text-sm">Selesai</p>
                        <p class="text-2xl font-bold text-white">{{ $transaksis->where('status', 'Selesai')->count() }}</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-gaming-card rounded-xl p-6 border border-yellow-500 border-opacity-30 hover:border-opacity-60 transition-all duration-300">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-500 bg-opacity-20 rounded-lg">
                        <i class="fas fa-clock text-yellow-400 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-400 text-sm">Pending</p>
                        <p class="text-2xl font-bold text-white">{{ $transaksis->where('status', 'Pending')->count() }}</p>
                    </div>
                </div>
            </div>

            <div
                class="bg-gaming-card rounded-xl p-6 border border-red-500 border-opacity-30 hover:border-opacity-60 transition-all duration-300">
                <div class="flex items-center">
                    <div class="p-3 bg-red-500 bg-opacity-20 rounded-lg">
                        <i class="fas fa-times-circle text-red-400 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-400 text-sm">Dibatalkan</p>
                        <p class="text-2xl font-bold text-white">{{ $transaksis->where('status', 'Dibatalkan')->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="bg-gaming-card rounded-2xl border border-gaming-primary border-opacity-30 shadow-2xl overflow-hidden">
            <!-- Table Header -->
            <div class="bg-gaming-primary bg-opacity-20 px-6 py-4 border-b border-gaming-primary border-opacity-30">
                <h3 class="text-xl font-bold text-gaming-primary flex items-center">
                    <i class="fas fa-table mr-3"></i>
                    Data Transaksi
                </h3>
            </div>

            <!-- Table Content -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gaming-primary text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">
                                <i class="fas fa-barcode mr-2"></i>Kode Tiket
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">
                                <i class="fas fa-user mr-2"></i>Nama Pembeli
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">
                                <i class="fas fa-money-bill-wave mr-2"></i>Harga
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">
                                <i class="fas fa-info-circle mr-2"></i>Status
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-bold uppercase tracking-wider">
                                <i class="fas fa-calendar mr-2"></i>Tanggal
                            </th>
                            <th class="px-6 py-4 text-center text-sm font-bold uppercase tracking-wider">
                                <i class="fas fa-cogs mr-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gaming-primary divide-opacity-20">
                        @forelse($transaksis as $transaksi)
                            <tr class="hover:bg-gaming-primary hover:bg-opacity-5 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-gaming-primary bg-opacity-20 rounded-lg mr-3">
                                            <i class="fas fa-ticket-alt text-gaming-primary"></i>
                                        </div>
                                        <span class="text-white font-mono font-semibold">{{ $transaksi->kode_produk }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 bg-gaming-primary rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-white text-sm"></i>
                                        </div>
                                        <span class="text-white font-medium">{{ $transaksi->nama_user }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-gaming-primary font-bold text-lg">
                                        Rp {{ number_format($transaksi->harga, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($transaksi->status == 'Selesai')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-500 bg-opacity-20 text-green-300 border border-green-500">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Selesai
                                        </span>
                                    @elseif($transaksi->status == 'Pending')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-500 bg-opacity-20 text-yellow-300 border border-yellow-500">
                                            <i class="fas fa-clock mr-1"></i>
                                            Pending
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-500 bg-opacity-20 text-red-300 border border-red-500">
                                            <i class="fas fa-times-circle mr-1"></i>
                                            {{ $transaksi->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                                    <div class="flex flex-col">
                                        <span class="font-medium">{{ $transaksi->created_at->format('d/m/Y') }}</span>
                                        <span class="text-sm text-gray-400">{{ $transaksi->created_at->format('H:i') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        @if($transaksi->status == 'Pending')
                                            <!-- Konfirmasi Button -->
                                            <form action="{{ route('transaksi.konfirmasi', $transaksi->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-all duration-200 transform hover:scale-105">
                                                    <i class="fas fa-check mr-1"></i>
                                                    Konfirmasi
                                                </button>
                                            </form>

                                            <!-- Batalkan Button -->
                                            <form action="{{ route('transaksi.batal', $transaksi->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                <button type="submit"
                                                    onclick="return confirm('Yakin ingin membatalkan transaksi ini?')"
                                                    class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-all duration-200 transform hover:scale-105">
                                                    <i class="fas fa-times mr-1"></i>
                                                    Batalkan
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-500 text-sm italic">No action available</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-inbox text-gaming-primary text-6xl mb-4 opacity-50"></i>
                                        <h3 class="text-xl font-medium text-gray-300 mb-2">Tidak ada data transaksi</h3>
                                        <p class="text-gray-500">Belum ada transaksi yang tercatat dalam sistem</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination (if needed) -->
            @if(method_exists($transaksis, 'links'))
                <div class="px-6 py-4 bg-gaming-primary bg-opacity-10 border-t border-gaming-primary border-opacity-30">
                    {{ $transaksis->links() }}
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            // Add confirmation with SweetAlert style (if you want to enhance it)
            function confirmAction(message, callback) {
                if (confirm(message)) {
                    callback();
                }
            }

            // Auto refresh page every 30 seconds for real-time updates
            // setInterval(function() {
            //     window.location.reload();
            // }, 30000);
        </script>
    @endpush
@endsection