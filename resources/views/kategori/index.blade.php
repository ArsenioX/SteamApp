@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6 bg-[#1a1a2e] text-white rounded-xl shadow-lg">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-purple-400">📂 Daftar Kategori</h2>
            <a href="{{ route('kategori.create') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300">
                ➕ Tambah Kategori
            </a>
        </div>

        <div class="overflow-x-auto rounded-lg">
            <table class="min-w-full bg-[#2e2e3a] border border-purple-700 rounded-lg text-white">
                <thead>
                    <tr class="bg-purple-700 text-white">
                        <th class="py-3 px-4 text-left">Nama Kategori</th>
                        <th class="py-3 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategoris as $kategori)
                        <tr class="border-t border-purple-600 hover:bg-[#3a3a4d]">
                            <td class="py-3 px-4">{{ $kategori->nama }}</td>
                            <td class="py-3 px-4 flex space-x-2">
                                <a href="{{ route('kategori.edit', $kategori->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold py-1 px-3 rounded-md text-sm">Edit</a>

                                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded-md text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="py-3 px-4 text-center text-gray-400">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection