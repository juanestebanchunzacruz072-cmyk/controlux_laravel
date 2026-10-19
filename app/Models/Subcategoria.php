<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subcategoria extends Model
{
    use HasFactory;

    protected $table = 'subcategoria';

    protected $primaryKey = 'id_subcategoria';

    public $timestamps = false;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'id_categoria',
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
     * Scope a query to only include active subcategories.
     *
     * @param  Builder<Subcategoria>  $query
     */
    public function scopeActivo(Builder $query): void
    {
        $query->where('activo', true);
    }

    /**
     * Get parent category.
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    /**
     * Get products belonging to this subcategory.
     */
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'id_subcategoria', 'id_subcategoria');
    }

    /**
     * Get brands associated with this subcategory.
     */
    public function marcas(): BelongsToMany
    {
        return $this->belongsToMany(Marca::class, 'marcas_subcategorias', 'id_subcategoria', 'id_marca', 'id_subcategoria', 'id_marca');
    }
}
