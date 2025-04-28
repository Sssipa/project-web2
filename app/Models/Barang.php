<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['user_id', 'kategori_id', 'nama', 'deskripsi', 'harga', 'gambar', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    public function pembelians()
    {
        return $this->hasOne(Pembelian::class, 'barang_id');
    }
}
