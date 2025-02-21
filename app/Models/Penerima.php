<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Penerima extends Model
{
    use HasFactory, HasRoles;

    protected $fillable =
    [
        'nama',
        'kategori_id',
        'lingkungan_id',
        'tahun'
    ];
    public function lingkungan()
    {
        return $this->belongsTo(Lingkungan::class);
    }

    
    public function kategoriPenerima()
    {
        return $this->belongsTo(KategoriPenerima::class, 'kategori_id'); 
    }
    
}
