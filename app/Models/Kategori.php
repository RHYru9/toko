<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "kategori";

    // Since you're using guarded for id, you should specify fillable for other fields
    protected $fillable = [
        'nama_kategori'  // Make sure this matches your database column name
    ];

    protected $guarded = ['id'];

    /**
     * Relationship with Produk model
     */
    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }

    /**
     * Count active products in this category
     */
    public function countActiveProduk(): int
    {
        return $this->produk()->where('status', 1)->count();
    }
}
