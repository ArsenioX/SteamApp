<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; // PENTING: Import ini wajib ada
use Illuminate\Support\Facades\Auth;
class ProdukController extends Controller
{
    // Menampilkan semua produk (user)
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategoriId = $request->input('kategori');

        $query = Produk::with('kategori');

        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%');
        }

        if ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        }

        $produks = $query->get();
        $kategoris = Kategori::all();

        return view('adminHome', [
            'produks' => $produks,
            'kategoris' => $kategoris,
            'search' => $search,
            'kategoriId' => $kategoriId,
        ]);
    }

    // Menampilkan form tambah produk (admin)
    public function create()
    {
        $kategoris = Kategori::all();
        return view('produk.create', compact('kategoris'));
    }

    // Menambah produk baru (admin)
    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|unique:produks',
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori_id' => 'required|exists:kategoris,id',
            'platform' => 'required',
            'zip_file' => 'nullable|file|mimes:zip|max:10240',
            'gambar' => 'nullable|image|max:2048',
            
        ]); 

        try {
            $uploadedFiles = $this->handleFileUpload($request);

            Produk::create(array_merge($request->only([
                'kode_produk',
                'nama',
                'deskripsi',
                'harga',
                'stok',
                'kategori_id',
                'platform',
            ]), $uploadedFiles, ['user_id' => Auth::id()])); // <--- Tambahkan user_id di sini

            return redirect()->route('admin.Home')->with('success', 'Produk berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Edit produk (admin)
    public function edit($id)
    {
        $produk = Produk::find($id);
        $kategoris = Kategori::all();
        return view('produk.edit', compact('produk', 'kategoris'));
    }

    // Update produk (admin)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori_id' => 'required|exists:kategoris,id',
            'platform' => 'required',
            'zip_file' => 'nullable|file|mimes:zip|max:10240',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $produk = Produk::find($id);

        try {
            $uploadedFiles = $this->handleFileUpload($request, $produk);

            $produk->update(array_merge($request->only([
                'nama',
                'deskripsi',
                'harga',
                'stok',
                'kategori_id',
                'platform',
            ]), $uploadedFiles));

            return redirect()->route('adminHome')->with('success', 'Produk berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Hapus produk (admin) - SUDAH DIPERBAIKI
    public function destroy($id)
    {
        $produk = Produk::find($id);

        // Cek apakah produk ada
        if (!$produk) {
            // GANTI DI SINI: dari 'adminHome' menjadi 'produk.index'
            return redirect()->route('produk.index')->withErrors(['error' => 'Data produk tidak ditemukan atau sudah dihapus.']);
        }

        // ... proses hapus gambar dan folder (biarkan kode perbaikan tadi) ...
        if ($produk->gambar) {
            $pathGambar = str_replace('storage/', '', $produk->gambar);
            Storage::disk('public')->delete($pathGambar);
        }
        if ($produk->zip_file) {
            $pathZip = str_replace('storage/', '', $produk->zip_file);
            Storage::disk('public')->delete($pathZip);
        }
        $slug = $produk->kode_produk;
        $gameFolder = public_path('games/' . $slug);
        if (file_exists($gameFolder)) {
            File::deleteDirectory($gameFolder);
        }

        $produk->delete();

        // GANTI DI SINI JUGA: dari 'adminHome' menjadi 'produk.index'
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }

    // Helper Upload File - SUDAH DIPERBAIKI (Security Update)
    private function handleFileUpload($request, $produk = null)
    {
        $data = [];

        // Handle ZIP File
        if ($request->hasFile('zip_file')) {
            $rawSlug = $request->kode_produk ?? $produk->kode_produk;
            // Sanitasi nama folder untuk keamanan
            $slug = \Illuminate\Support\Str::slug($rawSlug);

            // Simpan ZIP
            $zipPath = $request->file('zip_file')->storeAs(
                'games_zip',
                $slug . '.zip',
                'public'
            );

            // Path folder ekstrak
            $extractPath = public_path('games/' . $slug);

            // Bersihkan folder lama jika ada (Clean Install)
            if (file_exists($extractPath)) {
                File::deleteDirectory($extractPath);
            }
            mkdir($extractPath, 0755, true);

            // Ekstrak ZIP dengan Aman
            $zip = new \ZipArchive;
            if ($zip->open(storage_path('app/public/' . $zipPath)) === TRUE) {
                for ($i = 0; $i < $zip->numFiles; $i++) {
                    $filename = $zip->getNameIndex($i);

                    // SECURITY CHECK: Lewati file yang mengandung ".." (Zip Slip)
                    if (strpos($filename, '..') !== false) {
                        continue;
                    }

                    $zip->extractTo($extractPath, $filename);
                }
                $zip->close();
            } else {
                throw new \Exception('Gagal mengekstrak file ZIP.');
            }

            $data['zip_file'] = 'storage/' . $zipPath;
        }

        // Handle Gambar
        if ($request->hasFile('gambar')) {
            if ($produk && $produk->gambar) {
                // Hapus gambar lama
                $pathLama = str_replace('storage/', '', $produk->gambar);
                Storage::disk('public')->delete($pathLama);
            }
            // Simpan gambar baru
            // Kita simpan path relative agar konsisten dengan `asset('storage/...')` di view
            $data['gambar'] = $request->file('gambar')->store('gambar-produk', 'public');
        }

        return $data;
    }
}
