<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = [
        'name',
    ];

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kategori_id');
    }
}
