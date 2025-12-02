@extends('layouts.transaction')
@section('content')
    <div class="max-w-4xl mx-auto bg-[#1a1a2e] p-6 rounded-xl shadow-xl border border-purple-800">
        <h2 class="text-xl font-bold mb-4">Data Tiket</h2>

        {{-- Tombol Navigasi --}}
        <div class="flex justify-between mb-4">
            <a href="{{ route('home') }}" class="text-purple-400 hover:underline">Beranda</a>
            <a href="{{ route('transaksi.transaksi') }}" class="text-purple-400 hover:underline">Bayar Tiket</a>
        </div>

        {{-- Notifikasi Sukses --}}
        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tabel Data --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-white border-collapse">
                <thead>
                    <tr class="bg-purple-800">
                        <th class="px-4 py-2">Kode Produk</th>
                        <th class="px-4 py-2">Nama Pembeli</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Tanggal Transaksi</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                        <tr class="bg-[#0f172a] border-b border-gray-700">
                            <td class="px-4 py-2">{{ $cart->kode_produk }}</td>
                            <td class="px-4 py-2">{{ $cart->nama_user }}</td>
                            <td class="px-4 py-2">{{ $cart->harga }}</td>
                            <td
                                class="px-4 py-2 text-{{ $cart->status == 'Selesai' ? 'green-400' : ($cart->status == 'Pending' ? 'red-400' : 'gray-400') }}">
                                {{ $cart->status }}
                            </td>
                            <td class="px-4 py-2">{{ $cart->created_at }}</td>
                            <td class="px-4 py-2 text-center space-x-2">
                                <a href="{{ route('home') }}"
                                    class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-500">Beranda</a>
                                <form action="{{ route('transaksi.bayar') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                    <button type="submit"
                                        class="px-3 py-1 bg-green-600 text-white rounded-lg text-sm hover:bg-green-500">Bayar</button>
                                </form>
                                <form action="{{ route('transaksi.clearcart', $cart->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('POST')
                                    @if($cart->status == 'Pending')
                                        <button type="submit"
                                            class="px-3 py-1 bg-red-600 text-white rounded-lg text-sm hover:bg-red-500">Batal</button>
                                    @elseif($cart->status == 'Selesai')
                                        <a href="{{ route('transaksi.cetak', $cart->id) }}" target="_blank"
                                            class="px-3 py-1 bg-yellow-600 text-white rounded-lg text-sm hover:bg-yellow-500">Cetak</a>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection