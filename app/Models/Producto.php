<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    use HasFactory;

    public const CREATED_AT = 'fecha_creacion';

    public const UPDATED_AT = 'fecha_actualizacion';

    protected $table = 'productos';

    protected $primaryKey = 'id_producto';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'id_marca',
        'id_categoria',
        'id_subcategoria',
        'genero',
        'referencia',
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'activo',
        'img',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'precio' => 'decimal:2',
            'stock' => 'integer',
            'activo' => 'boolean',
            'fecha_creacion' => 'datetime',
            'fecha_actualizacion' => 'datetime',
        ];
    }

    /**
     * Scope a query to only include active products.
     *
     * @param  Builder<Producto>  $query
     */
    public function scopeActivo(Builder $query): void
    {
        $query->where('activo', true);
    }

    /**
     * Scope a query to only include in-stock products.
     *
     * @param  Builder<Producto>  $query
     */
    public function scopeConStock(Builder $query): void
    {
        $query->where('stock', '>', 0);
    }

    /**
     * Scope by category.
     *
     * @param  Builder<Producto>  $query
     */
    public function scopePorCategoria(Builder $query, int $idCategoria): void
    {
        $query->where('id_categoria', $idCategoria);
    }

    /**
     * Scope by gender (Hombre, Mujer, Unisex).
     *
     * @param  Builder<Producto>  $query
     */
    public function scopePorGenero(Builder $query, string $genero): void
    {
        $query->where('genero', $genero);
    }

    /**
     * Get the brand of the product.
     */
    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class, 'id_marca', 'id_marca');
    }

    /**
     * Get the category of the product.
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    /**
     * Get the subcategory of the product.
     */
    public function subcategoria(): BelongsTo
    {
        return $this->belongsTo(Subcategoria::class, 'id_subcategoria', 'id_subcategoria');
    }

    /**
     * Get order details for this product.
     */
    public function detallesPedido(): HasMany
    {
        return $this->hasMany(DetallePedido::class, 'id_producto', 'id_producto');
    }

    /**
     * Get cart details for this product.
     */
    public function detallesCarrito(): HasMany
    {
        return $this->hasMany(DetalleCarrito::class, 'id_producto', 'id_producto');
    }

    /**
     * Formatted price in COP currency.
     */
    public function getPrecioFormateadoAttribute(): string
    {
        return '$ '.number_format((float) $this->precio, 0, ',', '.');
    }

    /**
     * Check if product is available in stock.
     */
    public function getEnStockAttribute(): bool
    {
        return (int) $this->stock > 0;
    }
}
