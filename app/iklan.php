<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class iklan extends Model
{
    protected $table = "iklan";

    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'harga',
    ];
}
