<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $primaryKey = 'id_usuario';

    public $timestamps = false;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'id_rol',
        'nombre',
        'apellido',
        'cedula',
        'correo',
        'password',
        'telefono',
        'direccion',
        'barrio',
        'ciudad',
        'activo',
        'fecha_registro',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'fecha_registro' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's role.
     */
    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    /**
     * Get the orders for the user.
     */
    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class, 'id_usuario', 'id_usuario');
    }

    /**
     * Get the active cart for the user.
     */
    public function carrito(): HasOne
    {
        return $this->hasOne(Carrito::class, 'id_usuario', 'id_usuario');
    }

    /**
     * Determine if the user is an administrator.
     */
    public function isAdmin(): bool
    {
        return (int) $this->id_rol === Rol::ADMIN;
    }

    /**
     * Get full name attribute.
     */
    public function getNombreCompletoAttribute(): string
    {
        return trim("{$this->nombre} {$this->apellido}");
    }

    /**
     * Compatibility accessor for Laravel's default email property.
     */
    public function getEmailAttribute(): ?string
    {
        return $this->correo;
    }

    /**
     * Compatibility mutator for Laravel's default email property.
     */
    public function setEmailAttribute(?string $value): void
    {
        $this->attributes['correo'] = $value;
    }

    /**
     * Route notifications for the mail channel.
     */
    public function routeNotificationForMail(): string
    {
        return $this->correo ?? '';
    }
}
