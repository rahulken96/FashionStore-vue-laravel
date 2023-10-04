<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukGaleri extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_galleries';
    protected $primaryKey = 'produk_galeri_id';
    protected $guarded = ['produk_galeri_id'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id','produk_id');
    }

    public function getFotoProdukAttribute($value) /* Fungsi yang dipakai untuk url gambar dengan menambahkan 'storage/' didepannya */
    {
        return url('storage/' . $value);
        // return url('gambar-produk/' . $value);
    }
}
