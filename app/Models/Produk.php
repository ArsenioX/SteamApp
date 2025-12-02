<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi
    protected $fillable = [
        'kode_produk',
        'nama',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
        'kategori_id',
        'platform',
        'zip_file',
        'user_id'
    ];





    public function carts()
    {
        return $this->hasMany(Cart::class, 'kode_produk', 'kode_produk');
    }
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    

}
