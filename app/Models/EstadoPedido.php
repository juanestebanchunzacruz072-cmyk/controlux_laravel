<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EstadoPedido extends Model
{
    use HasFactory;

    public const RECIBIDO = 1;

    public const EMPACADO = 2;

    public const ENVIADO = 3;

    public const ENTREGADO = 4;

    protected $table = 'estado_pedidos';

    protected $primaryKey = 'id_estado';

    public $timestamps = false;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /**
     * Get orders with this status.
     */
    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class, 'id_estado', 'id_estado');
    }
}
