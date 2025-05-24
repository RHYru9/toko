<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'kategori_id',
        'user_id',
        'status',
        'nama_produk',
        'detail',
        'harga',
        'stok',
        'berat',
        'foto'
    ];

    // Add this for easy access to formatted price
    protected $appends = ['formatted_harga'];

    /**
     * Relationship with Kategori
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Relationship with User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship with OrderItem
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'produk_id');
    }

    /**
     * Accessor for formatted price
     */
    public function getFormattedHargaAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * Scope for active products
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope for products in a category
     */
    public function scopeInKategori($query, $kategori_id)
    {
        return $query->where('kategori_id', $kategori_id);
    }
}
