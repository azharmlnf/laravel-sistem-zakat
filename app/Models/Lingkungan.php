<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Lingkungan extends Model
{
    use HasFactory ,HasRoles;

    protected $fillable=[
        'nama',
        'rt',
        'rw'
    ];
}
