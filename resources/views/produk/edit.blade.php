@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6 bg-[#1a1a2e] text-white rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-purple-400">🛠️ Edit Produk</h2>
        <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="kode_produk" class="block mb-1 text-purple-300">Kode Produk</label>
                <input type="text" name="kode_produk" value="{{ $produk->kode_produk }}"
                    class="w-full bg-[#2e2e3a] border border-purple-500 rounded-lg p-2 text-white focus:ring-2 focus:ring-purple-600"
                    required>
            </div>

            <div>
                <label for="nama" class="block mb-1 text-purple-300">Nama</label>
                <input type="text" name="nama" value="{{ $produk->nama }}"
                    class="w-full bg-[#2e2e3a] border border-purple-500 rounded-lg p-2 text-white focus:ring-2 focus:ring-purple-600"
                    required>
            </div>

            <div>
                <label for="harga" class="block mb-1 text-purple-300">Harga</label>
                <input type="number" name="harga" value="{{ $produk->harga }}"
                    class="w-full bg-[#2e2e3a] border border-purple-500 rounded-lg p-2 text-white focus:ring-2 focus:ring-purple-600"
                    required>
            </div>

            <div>
                <label for="stok" class="block mb-1 text-purple-300">Stok</label>
                <input type="number" name="stok" value="{{ $produk->stok }}"
                    class="w-full bg-[#2e2e3a] border border-purple-500 rounded-lg p-2 text-white focus:ring-2 focus:ring-purple-600"
                    required>
            </div>

            <div>
                <label for="kategori_id" class="block mb-1 text-purple-300">Kategori</label>
                <select name="kategori_id"
                    class="w-full bg-[#2e2e3a] border border-purple-500 rounded-lg p-2 text-white focus:ring-2 focus:ring-purple-600"
                    required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="platform" class="block mb-1 text-purple-300">Platform</label>
                <input type="text" name="platform" value="{{ $produk->platform }}"
                    class="w-full bg-[#2e2e3a] border border-purple-500 rounded-lg p-2 text-white focus:ring-2 focus:ring-purple-600"
                    required>
            </div>

            <div>
                <label for="gambar" class="block mb-1 text-purple-300">Gambar Produk</label>
                <input type="file" name="gambar" accept="image/*"
                    class="w-full bg-[#2e2e3a] text-white border border-purple-500 rounded-lg p-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700">
                @if($produk->gambar)
                    <div class="mt-3">
                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar Produk"
                            class="w-48 border border-purple-500 rounded-lg">
                    </div>
                @endif
            </div>

            @if($produk->zip_file)
                <p class="text-sm text-purple-300">🎮 File ZIP sudah ada: <span
                        class="font-semibold">{{ $produk->zip_file }}</span></p>
            @endif

            <button type="submit"
                class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300">
                💾 Simpan Perubahan
            </button>
        </form>
    </div>
@endsection