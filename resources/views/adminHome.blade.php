@extends('layouts.admin')

@section('content')
    <div class="px-6 py-6">
        <h2 class="text-2xl font-semibold text-white mb-6">Overview</h2>

        {{-- Form Search dan Filter --}}
        <form method="GET" action="{{ route('produk.index') }}" class="mb-6 flex flex-wrap items-center gap-4">
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


        <div class="bg-gray-800 rounded-lg shadow overflow-x-auto">
            <table class="min-w-full text-white table-auto">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">Gambar</th>
                        <th class="px-4 py-2 text-left">Kode Produk</th>
                        <th class="px-4 py-2 text-left">Nama Produk</th>
                        <th class="px-4 py-2 text-left">Harga</th>
                        <th class="px-4 py-2 text-left">Kategori</th>
                        <th class="px-4 py-2 text-left">Stok</th>
                        <th class="px-4 py-2 text-left">Platform</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-900 divide-y divide-gray-700">
                    @forelse($produks as $produk)
                        <tr>
                            <td class="px-4 py-2">
                                @if($produk->gambar)
                                    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar Produk"
                                        class="w-12 h-12 object-cover rounded">
                                @else
                                    <span class="italic text-gray-400">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $produk->kode_produk }}</td>
                            <td class="px-4 py-2 capitalize">{{ $produk->nama }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($produk->harga, 2, ',', '.') }}</td>
                            <td class="px-4 py-2 capitalize">{{ $produk->kategori->nama ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $produk->stok }}</td>
                            <td class="px-4 py-2 uppercase">{{ $produk->platform }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('produk.edit', $produk->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-3 py-1 rounded">Edit</a>
                                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1 rounded">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center px-4 py-4 text-gray-400">Tidak ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection