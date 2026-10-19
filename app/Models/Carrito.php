<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carrito extends Model
{
    use HasFactory;

    public const CREATED_AT = 'fecha_creacion';

    public const UPDATED_AT = 'fecha_actualizacion';

    protected $table = 'carrito';

    protected $primaryKey = 'id_carrito';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'id_usuario',
        'estado',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha_creacion' => 'datetime',
            'fecha_actualizacion' => 'datetime',
        ];
    }

    /**
     * Scope a query to only include active carts.
     *
     * @param  Builder<Carrito>  $query
     */
    public function scopeActivo(Builder $query): void
    {
        $query->where('estado', 'ACTIVO');
    }

    /**
     * Get the customer associated with this cart.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    /**
     * Get the items in this cart.
     */
    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleCarrito::class, 'id_carrito', 'id_carrito');
    }

    /**
     * Calculate cart total amount.
     */
    public function getTotalAttribute(): float
    {
        return (float) $this->detalles->sum('subtotal');
    }

    /**
     * Calculate cart total items count.
     */
    public function getCantidadTotalAttribute(): int
    {
        return (int) $this->detalles->sum('cantidad');
    }

    /**
     * Formatted cart total in COP currency.
     */
    public function getTotalFormateadoAttribute(): string
    {
        return '$ '.number_format($this->total, 0, ',', '.');
    }
}
