<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleCarrito extends Model
{
    use HasFactory;

    protected $table = 'detalle_carrito';

    protected $primaryKey = 'id_detalle_carrito';

    public $timestamps = false;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'id_carrito',
        'id_producto',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'cantidad' => 'integer',
            'precio_unitario' => 'decimal:2',
            'subtotal' => 'decimal:2',
        ];
    }

    /**
     * Get the cart that contains this detail.
     */
    public function carrito(): BelongsTo
    {
        return $this->belongsTo(Carrito::class, 'id_carrito', 'id_carrito');
    }

    /**
     * Get the product associated with this cart item.
     */
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    /**
     * Formatted subtotal in COP currency.
     */
    public function getSubtotalFormateadoAttribute(): string
    {
        return '$ '.number_format((float) $this->subtotal, 0, ',', '.');
    }
}
