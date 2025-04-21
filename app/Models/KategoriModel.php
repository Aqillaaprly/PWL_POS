<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriModel extends Model
{
    use HasFactory;

    protected $table = 'm_category'; // Explicitly define the correct table name
    protected $primaryKey = 'category_id'; // Define the primary key

    public $timestamps = false; // Jika tidak ada timestamps (created_at, updated_at)

    protected $fillable = ['category_code', 'category_name']; // Pastikan kolom bisa diisi

    public function users(): HasMany
    {
        return $this->hasMany(UserModel::class, 'category_id', 'category_id');
    }
}