<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class JenisZakat extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'jenis_zakats';
    protected $fillable = ['nama', 'satuan'];

    // Ambil daftar ENUM dari database
    public static function getEnumValues(string $column): array
    {
        $type = DB::select("SHOW COLUMNS FROM jenis_zakats WHERE Field = ?", [$column])[0]->Type;
        preg_match('/enum\((.*)\)$/', $type, $matches);
        $values = str_getcsv($matches[1], ",", "'");

        return array_combine($values, $values);
    }
}
