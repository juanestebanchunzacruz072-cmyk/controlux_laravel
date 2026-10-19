<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $primaryKey = 'id_pedido';

    public $timestamps = false;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'id_usuario',
        'id_estado',
        'fecha_pedido',
        'subtotal',
        'total',
        'direccion_entrega',
        'observaciones',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'total' => 'decimal:2',
            'fecha_pedido' => 'datetime',
        ];
    }

    /**
     * Get the customer who placed the order.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    /**
     * Get the current status of the order.
     */
    public function estado(): BelongsTo
    {
        return $this->belongsTo(EstadoPedido::class, 'id_estado', 'id_estado');
    }

    /**
     * Get the line items of the order.
     */
    public function detalles(): HasMany
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido', 'id_pedido');
    }

    /**
     * Formatted total in COP currency.
     */
    public function getTotalFormateadoAttribute(): string
    {
        return '$ '.number_format((float) $this->total, 0, ',', '.');
    }
}
