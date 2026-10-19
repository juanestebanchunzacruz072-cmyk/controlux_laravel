<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->increments('id_rol');
                $table->string('nombre', 50)->unique();
                $table->string('descripcion', 150)->nullable();
            });
        }

        if (! Schema::hasTable('usuarios')) {
            Schema::create('usuarios', function (Blueprint $table) {
                $table->increments('id_usuario');
                $table->unsignedInteger('id_rol')->default(2);
                $table->string('nombre', 100);
                $table->string('apellido', 100);
                $table->string('cedula', 20)->nullable();
                $table->string('correo', 150)->unique();
                $table->string('password', 255);
                $table->string('telefono', 20)->nullable();
                $table->string('direccion', 200)->nullable();
                $table->string('barrio', 100)->nullable();
                $table->string('ciudad', 100)->nullable();
                $table->boolean('activo')->default(true);
                $table->dateTime('fecha_registro')->useCurrent();

                $table->foreign('id_rol')->references('id_rol')->on('roles');
            });
        }

        if (! Schema::hasTable('categorias')) {
            Schema::create('categorias', function (Blueprint $table) {
                $table->increments('id_categoria');
                $table->string('nombre', 100)->unique();
                $table->string('descripcion', 255)->nullable();
                $table->boolean('activo')->default(true);
            });
        }

        if (! Schema::hasTable('subcategoria')) {
            Schema::create('subcategoria', function (Blueprint $table) {
                $table->increments('id_subcategoria');
                $table->unsignedInteger('id_categoria');
                $table->string('nombre', 100);
                $table->string('descripcion', 255)->nullable();
                $table->boolean('activo')->default(true);

                $table->foreign('id_categoria')->references('id_categoria')->on('categorias');
            });
        }

        if (! Schema::hasTable('marcas')) {
            Schema::create('marcas', function (Blueprint $table) {
                $table->increments('id_marca');
                $table->string('nombre', 100)->unique();
                $table->text('descripcion')->nullable();
                $table->boolean('activo')->default(true);
            });
        }

        if (! Schema::hasTable('marcas_categorias')) {
            Schema::create('marcas_categorias', function (Blueprint $table) {
                $table->unsignedInteger('id_marca');
                $table->unsignedInteger('id_categoria');
                $table->primary(['id_marca', 'id_categoria']);

                $table->foreign('id_marca')->references('id_marca')->on('marcas')->cascadeOnDelete();
                $table->foreign('id_categoria')->references('id_categoria')->on('categorias')->cascadeOnDelete();
            });
        }

        if (! Schema::hasTable('marcas_subcategorias')) {
            Schema::create('marcas_subcategorias', function (Blueprint $table) {
                $table->unsignedInteger('id_marca');
                $table->unsignedInteger('id_subcategoria');
                $table->primary(['id_marca', 'id_subcategoria']);

                $table->foreign('id_marca')->references('id_marca')->on('marcas')->cascadeOnDelete();
                $table->foreign('id_subcategoria')->references('id_subcategoria')->on('subcategoria')->cascadeOnDelete();
            });
        }

        if (! Schema::hasTable('productos')) {
            Schema::create('productos', function (Blueprint $table) {
                $table->increments('id_producto');
                $table->unsignedInteger('id_marca');
                $table->unsignedInteger('id_categoria');
                $table->unsignedInteger('id_subcategoria')->nullable();
                $table->enum('genero', ['Hombre', 'Mujer', 'Unisex'])->default('Unisex');
                $table->string('referencia', 50)->unique();
                $table->string('nombre', 150);
                $table->text('descripcion')->nullable();
                $table->decimal('precio', 12, 2);
                $table->integer('stock')->default(0);
                $table->boolean('activo')->default(true);
                $table->dateTime('fecha_creacion')->useCurrent();
                $table->dateTime('fecha_actualizacion')->nullable();
                $table->string('img', 255)->nullable();

                $table->foreign('id_marca')->references('id_marca')->on('marcas');
                $table->foreign('id_categoria')->references('id_categoria')->on('categorias');
                $table->foreign('id_subcategoria')->references('id_subcategoria')->on('subcategoria')->nullOnDelete();
            });
        }

        if (! Schema::hasTable('estado_pedidos')) {
            Schema::create('estado_pedidos', function (Blueprint $table) {
                $table->increments('id_estado');
                $table->string('nombre', 50)->unique();
                $table->string('descripcion', 150)->nullable();
            });
        }

        if (! Schema::hasTable('pedidos')) {
            Schema::create('pedidos', function (Blueprint $table) {
                $table->increments('id_pedido');
                $table->unsignedInteger('id_usuario');
                $table->unsignedInteger('id_estado')->default(1);
                $table->dateTime('fecha_pedido')->useCurrent();
                $table->decimal('subtotal', 12, 2)->default(0);
                $table->decimal('total', 12, 2)->default(0);
                $table->string('direccion_entrega', 250)->nullable();
                $table->text('observaciones')->nullable();

                $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');
                $table->foreign('id_estado')->references('id_estado')->on('estado_pedidos');
            });
        }

        if (! Schema::hasTable('detalle_pedidos')) {
            Schema::create('detalle_pedidos', function (Blueprint $table) {
                $table->increments('id_detalle_pedido');
                $table->unsignedInteger('id_pedido');
                $table->unsignedInteger('id_producto');
                $table->integer('cantidad')->default(1);
                $table->decimal('precio_unitario', 12, 2);
                $table->decimal('subtotal', 12, 2);

                $table->foreign('id_pedido')->references('id_pedido')->on('pedidos')->cascadeOnDelete();
                $table->foreign('id_producto')->references('id_producto')->on('productos');
            });
        }

        if (! Schema::hasTable('carrito')) {
            Schema::create('carrito', function (Blueprint $table) {
                $table->increments('id_carrito');
                $table->unsignedInteger('id_usuario');
                $table->string('estado', 30)->default('ACTIVO');
                $table->dateTime('fecha_creacion')->useCurrent();
                $table->dateTime('fecha_actualizacion')->nullable();

                $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');
            });
        }

        if (! Schema::hasTable('detalle_carrito')) {
            Schema::create('detalle_carrito', function (Blueprint $table) {
                $table->increments('id_detalle_carrito');
                $table->unsignedInteger('id_carrito');
                $table->unsignedInteger('id_producto');
                $table->integer('cantidad')->default(1);
                $table->decimal('precio_unitario', 12, 2);
                $table->decimal('subtotal', 12, 2);

                $table->foreign('id_carrito')->references('id_carrito')->on('carrito')->cascadeOnDelete();
                $table->foreign('id_producto')->references('id_producto')->on('productos');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_carrito');
        Schema::dropIfExists('carrito');
        Schema::dropIfExists('detalle_pedidos');
        Schema::dropIfExists('pedidos');
        Schema::dropIfExists('estado_pedidos');
        Schema::dropIfExists('productos');
        Schema::dropIfExists('marcas_subcategorias');
        Schema::dropIfExists('marcas_categorias');
        Schema::dropIfExists('marcas');
        Schema::dropIfExists('subcategoria');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('roles');
    }
};
