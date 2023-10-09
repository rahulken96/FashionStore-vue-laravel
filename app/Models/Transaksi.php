<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transactions';
    protected $primaryKey = 'transaksi_id';
    protected $guarded = ['transaksi_id'];

    public function detail()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }
}
