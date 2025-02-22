<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Zakat extends Model
{
    use HasFactory,HasRoles;

    protected $fillable=[
        'nama_pemberi',
        'lingkungan_id',
        'jenis_id',
        'jumlah',
        'tanggal',
        'tahun'
    ];

    public function lingkungan(){
        return $this->belongsTo(Lingkungan::class);
    }

    public function jenis_zakat()
    {
        return $this->belongsTo(JenisZakat::class, 'jenis_id');
    }
}
