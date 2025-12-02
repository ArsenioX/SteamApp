@extends('layouts.transaction')

@section('content')
    <div class="container mx-auto my-8 px-4">
        <div class="bg-purple-900 shadow-lg rounded-lg">
            <div
                class="bg-gradient-to-r from-purple-700 to-purple-800 text-orange-400 rounded-t-lg px-6 py-4 flex justify-between items-center">
                <h5 class="text-lg font-bold">Data Produk</h5>
                <div class="flex gap-2">
                    <a href="{{ route('home') }}"
                        class="bg-orange-400 text-purple-900 font-semibold py-1 px-4 rounded-lg shadow hover:bg-orange-500 transition">
                        Beranda
                    </a>
                    <a href="{{ route('transaksi.cart') }}"
                        class="bg-orange-400 text-purple-900 font-semibold py-1 px-4 rounded-lg shadow hover:bg-orange-500 transition">
                        Cart
                    </a>
                </div>
            </div>

            <div class="p-6">
                @if(session('success'))
                    <div class="bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200 rounded-lg shadow-sm">
                        <thead class="bg-purple-800 text-orange-400">
                            <tr>
                                <th class="py-2 px-4 text-left">Kode Produk</th>
                                <th class="py-2 px-4 text-left">Nama Pembeli</th>
                                <th class="py-2 px-4 text-left">Harga</th>
                                <th class="py-2 px-4 text-center">Status</th>
                                <th class="py-2 px-4 text-left">Tanggal Transaksi</th>
                                <th class="py-2 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksis as $transaksi)
                                <tr class="bg-purple-700 border-b hover:bg-purple-600">
                                    <td class="py-2 px-4 text-orange-300">{{ $transaksi->kode_produk }}</td>
                                    <td class="py-2 px-4 text-orange-300">{{ $transaksi->nama_user }}</td>
                                    <td class="py-2 px-4 text-orange-300">Rp {{ number_format($transaksi->harga, 0, ',', '.') }}
                                    </td>
                                    <td class="py-2 px-4 text-center">
                                        <span
                                            class="px-2 py-1 rounded text-sm font-semibold {{ $transaksi->status == 'Selesai' ? 'bg-green-300 text-green-900' : 'bg-red-300 text-red-900' }}">
                                            {{ $transaksi->status }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-4 text-orange-300">{{ $transaksi->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="py-2 px-4 text-center">
                                        @if($transaksi->status == 'Pending')
                                            <form id="cancelForm{{ $transaksi->id }}"
                                                action="{{ route('transaksi.clear', $transaksi->id) }}" method="POST"
                                                class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button type="button"
                                                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded-lg shadow-md text-sm transition"
                                                onclick="if(confirm('Apakah Anda yakin? Transaksi ini akan dibatalkan!')) { document.getElementById('cancelForm{{ $transaksi->id }}').submit(); }">
                                                Batal
                                            </button>
                                        @elseif($transaksi->status == 'Selesai')
                                            <a href="{{ route('transaksi.cetak', $transaksi->id) }}" target="_blank"
                                                class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded-lg shadow-md text-sm transition">
                                                Cetak
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @if($transaksis->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-orange-300">Belum ada transaksi.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection