<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $primaryKey = 'id_categoria';

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
     * Scope a query to only include active categories.
     *
     * @param  Builder<Categoria>  $query
     */
    public function scopeActivo(Builder $query): void
    {
        $query->where('activo', true);
    }

    /**
     * Get subcategories belonging to this category.
     */
    public function subcategorias(): HasMany
    {
        return $this->hasMany(Subcategoria::class, 'id_categoria', 'id_categoria');
    }

    /**
     * Get products belonging to this category.
     */
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'id_categoria', 'id_categoria');
    }

    /**
     * Get brands associated with this category.
     */
    public function marcas(): BelongsToMany
    {
        return $this->belongsToMany(Marca::class, 'marcas_categorias', 'id_categoria', 'id_marca', 'id_categoria', 'id_marca');
    }
}
