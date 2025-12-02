@extends('layouts.form')

@section('content')
    <div class="max-w-xl mx-auto">
        <h2 class="text-2xl font-bold text-purple-400 mb-6">➕ Tambah Kategori</h2>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kategori.store') }}" method="POST"
            class="space-y-5 bg-[#1a1a2e] p-6 rounded-xl shadow-md border border-purple-700">
            @csrf

            <div>
                <label for="nama" class="block text-purple-300 mb-1">Nama Kategori</label>
                <input type="text" name="nama" id="nama"
                    class="w-full p-2 rounded-lg bg-[#2e2e3a] border border-purple-500 text-white focus:outline-none focus:ring-2 focus:ring-purple-600"
                    required>
            </div>

            <div class="flex justify-between items-center">
                <button type="submit"
                    class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg transition-all">
                    💾 Simpan
                </button>
                <a href="{{ route('kategori.index') }}" class="text-purple-400 hover:underline font-medium">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection