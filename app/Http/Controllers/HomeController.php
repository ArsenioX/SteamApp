<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Kategori;

class HomeController extends Controller
{
    // Menambahkan middleware 'auth' untuk melindungi halaman
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Halaman utama user
    public function index(Request $request): View
    {
        $query = Produk::with('kategori'); // Eager loading kategori

        // Search berdasarkan nama produk (menggunakan 'q' sesuai form)
        if ($request->filled('q')) {
            $query->where('nama', 'like', '%' . $request->q . '%');
        }

        // Filter berdasarkan kategori (menggunakan 'kategori' sesuai form)
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Filter berdasarkan rentang harga
        if ($request->filled('harga_min')) {
            $query->where('harga', '>=', $request->harga_min);
        }

        if ($request->filled('harga_max')) {
            $query->where('harga', '<=', $request->harga_max);
        }

        // Sorting options untuk user
        $sortBy = $request->get('sort_by', 'created_at'); // Default sort by created_at
        $sortOrder = $request->get('sort_order', 'desc'); // Default desc

        // Validasi sorting options
        $allowedSortBy = ['nama', 'harga', 'created_at'];
        $allowedSortOrder = ['asc', 'desc'];

        if (!in_array($sortBy, $allowedSortBy)) {
            $sortBy = 'created_at';
        }

        if (!in_array($sortOrder, $allowedSortOrder)) {
            $sortOrder = 'desc';
        }

        // Gunakan paginate dan appends untuk menyimpan parameter pencarian di pagination links
        $produks = $query->orderBy($sortBy, $sortOrder)
            ->paginate(12) // 12 produk per halaman untuk user (lebih banyak dari admin)
            ->appends($request->only('q', 'kategori', 'harga_min', 'harga_max', 'sort_by', 'sort_order'));

        // Ambil semua kategori untuk dropdown kategori
        $kategoris = Kategori::all();

        // Hitung statistik untuk user
        $totalProduk = Produk::count();
        $totalKategori = Kategori::count();

        return view('home', compact('produks', 'kategoris', 'totalProduk', 'totalKategori'));
    }


    // Halaman admin untuk menampilkan produk
    public function adminHome(Request $request)
    {
        // Debugging: Periksa parameter pencarian
        //dd($request->all()); // Pastikan data query dan kategori diterima

        $query = Produk::query();

        // Search berdasarkan nama produk (menggunakan 'q' sesuai form)
        if ($request->filled('q')) {
            $query->where('nama', 'like', '%' . $request->q . '%');
        }

        // Filter berdasarkan kategori (menggunakan 'kategori' sesuai form)
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Gunakan paginate dan appends untuk menyimpan parameter pencarian di pagination links
        $produks = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends($request->only('q', 'kategori'));

        // Ambil semua kategori untuk dropdown kategori
        $kategoris = Kategori::all();

        return view('adminHome', compact('produks', 'kategoris'));
    }
    // Halaman admin untuk menambah produk
    public function create(): View
    {
        return view('produk.create');
    }

    // Simpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori' => 'required',
            'platform' => 'required',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('gambar-produk', 'public');
        }

        // Simpan produk baru
        Produk::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'platform' => $request->platform,
            'gambar' => $gambarPath ?? null,
        ]);

        return redirect()->route('adminHome')->with('success', 'Produk berhasil ditambahkan');
    }

    // Halaman admin untuk mengedit produk
    public function edit($id): View
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    // Update produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_produk' => 'required|unique:produks',
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori' => 'required',
            'platform' => 'required',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $produk = Produk::findOrFail($id);

        // Generate kode_produk otomatis


        // Menyimpan gambar baru jika ada
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('gambar-produk', 'public');
        }

        // Update produk dengan data baru
        $produk->update([
            'kode_produk' => $request->kode_produk,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'platform' => $request->platform,
            'gambar' => $gambarPath ?? $produk->gambar,  // Jika tidak ada gambar baru, tetap pakai gambar lama
        ]);

        return redirect()->route('adminHome')->with('success', 'Produk berhasil diperbarui');
    }

    // Hapus produk
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('adminHome')->with('success', 'Produk berhasil dihapus');
    }
}
