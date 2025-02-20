<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class PenanggungJawabLingkungan extends Model
{
    use HasFactory,HasRoles;
    protected $fillable =
    [        'user_id',
        'lingkungan_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lingkungan()
    {
        return $this->belongsTo(Lingkungan::class);
    }
}
