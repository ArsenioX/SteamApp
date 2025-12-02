@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6 bg-[#1a1a2e] text-white rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-purple-400">🎮 Tambah Game</h2>

        {{-- BAGIAN INI YANG KURANG TADI (PENAMPIL ERROR) --}}
        @if ($errors->any())
            <div class="bg-red-900 border border-red-500 text-red-100 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Gagal Menyimpan!</strong>
                <span class="block sm:inline">Silakan periksa inputan Anda:</span>
                <ul class="list-disc list-inside mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- END BAGIAN ERROR --}}

        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="kode_produk" class="block mb-1 text-purple-300">Kode Produk</label>
                {{-- value="{{ old('...') }}" berfungsi agar teks tidak hilang saat error --}}
                <input type="text" name="kode_produk" value="{{ old('kode_produk') }}"
                    class="w-full bg-[#2e2e3a] border border-purple-500 rounded-lg p-2 text-white focus:ring-2 focus:ring-purple-600"
                    required>
            </div>

            <div>
                <label for="nama" class="block mb-1 text-purple-300">Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                    class="w-full bg-[#2e2e3a] border border-purple-500 rounded-lg p-2 text-white focus:ring-2 focus:ring-purple-600"
                    required>
            </div>

            <div>
                <label for="harga" class="block mb-1 text-purple-300">Harga</label>
                <input type="number" name="harga" value="{{ old('harga') }}"
                    class="w-full bg-[#2e2e3a] border border-purple-500 rounded-lg p-2 text-white focus:ring-2 focus:ring-purple-600"
                    required>
            </div>

            <div>
                <label for="stok" class="block mb-1 text-purple-300">Stok</label>
                <input type="number" name="stok" value="{{ old('stok') }}"
                    class="w-full bg-[#2e2e3a] border border-purple-500 rounded-lg p-2 text-white focus:ring-2 focus:ring-purple-600"
                    required>
            </div>

            <div>
                <label for="kategori" class="block mb-1 text-purple-300">Kategori</label>
                <select name="kategori_id"
                    class="w-full bg-[#2e2e3a] border border-purple-500 rounded-lg p-2 text-white focus:ring-2 focus:ring-purple-600"
                    required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="platform" class="block mb-1 text-purple-300">Platform</label>
                <input type="text" name="platform" value="{{ old('platform') }}"
                    class="w-full bg-[#2e2e3a] border border-purple-500 rounded-lg p-2 text-white focus:ring-2 focus:ring-purple-600"
                    required>
            </div>

            <div>
                <label for="file_game" class="block mb-1 text-purple-300">File Game (ZIP)</label>
                <input type="file" name="zip_file" accept=".zip"
                    class="w-full bg-[#2e2e3a] text-white border border-purple-500 rounded-lg p-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700">
                <p class="text-xs text-gray-400 mt-1">*Maksimal 10MB</p>
            </div>

            <div>
                <label for="gambar" class="block mb-1 text-purple-300">Gambar Produk</label>
                <input type="file" name="gambar" accept="image/*"
                    class="w-full bg-[#2e2e3a] text-white border border-purple-500 rounded-lg p-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700">
                <p class="text-xs text-gray-400 mt-1">*Maksimal 2MB</p>
            </div>

            <button type="submit"
                class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300">
                💾 Simpan
            </button>
        </form>
    </div>
@endsection