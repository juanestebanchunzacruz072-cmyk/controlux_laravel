<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marca extends Model
{
    use HasFactory;

    protected $table = 'marcas';

    protected $primaryKey = 'id_marca';

    public $timestamps = false;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'activo',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
        ];
    }

    /**
     * Scope a query to only include active brands.
     *
     * @param  Builder<Marca>  $query
     */
    public function scopeActivo(Builder $query): void
    {
        $query->where('activo', true);
    }

    /**
     * Get products belonging to this brand.
     */
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'id_marca', 'id_marca');
    }

    /**
     * Get categories associated with this brand.
     */
    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class, 'marcas_categorias', 'id_marca', 'id_categoria', 'id_marca', 'id_categoria');
    }

    /**
     * Get subcategories associated with this brand.
     */
    public function subcategorias(): BelongsToMany
    {
        return $this->belongsToMany(Subcategoria::class, 'marcas_subcategorias', 'id_marca', 'id_subcategoria', 'id_marca', 'id_subcategoria');
    }
}
