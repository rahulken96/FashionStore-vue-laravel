<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'produk_id';
    protected $guarded = ['produk_id'];

    public function galeri()
    {
        return $this->hasMany(ProdukGaleri::class, 'produk_id');
    }
}
