<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class KategoriPembagianZakat extends Model
{
    use HasFactory, HasRoles;

    protected $fillable=
    [
        'kategori_id',
        'jumlah_beras',
        'jumlah_uang',
        'tahun'
    ];

    public function KategoriPenerima(){
        return $this->belongsTo(KategoriPenerima::class, 'kategori_id');
    }
}
