<?php

namespace Tests\Feature;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        if (Rol::count() === 0) {
            Rol::create(['id_rol' => Rol::ADMIN, 'nombre' => 'Administrador', 'descripcion' => 'Admin']);
            Rol::create(['id_rol' => Rol::CLIENTE, 'nombre' => 'Cliente', 'descripcion' => 'Cliente']);
        }
    }

    /**
     * Test login screen can be rendered.
     */
    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Iniciar Sesión');
    }

    /**
     * Test register screen can be rendered.
     */
    public function test_register_screen_can_be_rendered(): void
    {
        $response = $this->get('/registro');

        $response->assertStatus(200);
        $response->assertSee('Registro de Cliente');
    }

    /**
     * Test user can register successfully.
     */
    public function test_user_can_register_successfully(): void
    {
        $response = $this->post('/registro', [
            'nombre' => 'Carlos',
            'apellido' => 'Mendoza',
            'cedula' => '1098765432',
            'correo' => 'carlos@example.com',
            'telefono' => '3001234567',
            'direccion' => 'Calle 100 #20-15',
            'barrio' => 'Chicó',
            'ciudad' => 'Bogotá',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('usuarios', [
            'correo' => 'carlos@example.com',
            'nombre' => 'Carlos',
            'id_rol' => Rol::CLIENTE,
        ]);
    }

    /**
     * Test user can authenticate using valid credentials.
     */
    public function test_users_can_authenticate_using_valid_credentials(): void
    {
        $user = User::create([
            'id_rol' => Rol::CLIENTE,
            'nombre' => 'Wilson',
            'apellido' => 'Romero',
            'correo' => 'wilson@example.com',
            'password' => 'secret123',
            'activo' => true,
            'fecha_registro' => now(),
        ]);

        $response = $this->post('/login', [
            'correo' => 'wilson@example.com',
            'password' => 'secret123',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test user cannot authenticate with invalid password.
     */
    public function test_users_cannot_authenticate_with_invalid_password(): void
    {
        User::create([
            'id_rol' => Rol::CLIENTE,
            'nombre' => 'Wilson',
            'apellido' => 'Romero',
            'correo' => 'wilson2@example.com',
            'password' => 'secret123',
            'activo' => true,
            'fecha_registro' => now(),
        ]);

        $response = $this->post('/login', [
            'correo' => 'wilson2@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors('correo');
        $this->assertGuest();
    }

    /**
     * Test user can log out.
     */
    public function test_user_can_logout(): void
    {
        $user = User::create([
            'id_rol' => Rol::CLIENTE,
            'nombre' => 'Wilson',
            'apellido' => 'Romero',
            'correo' => 'wilson3@example.com',
            'password' => 'secret123',
            'activo' => true,
            'fecha_registro' => now(),
        ]);

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect(route('home'));
        $this->assertGuest();
    }

    /**
     * Test unauthenticated users are redirected from profile.
     */
    public function test_unauthenticated_users_are_redirected_from_profile(): void
    {
        $response = $this->get('/perfil');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * Test authenticated client can view their profile.
     */
    public function test_authenticated_user_can_view_profile(): void
    {
        $user = User::create([
            'id_rol' => Rol::CLIENTE,
            'nombre' => 'Wilson',
            'apellido' => 'Romero',
            'correo' => 'wilson4@example.com',
            'password' => 'secret123',
            'activo' => true,
            'fecha_registro' => now(),
        ]);

        $response = $this->actingAs($user)->get('/perfil');

        $response->assertStatus(200);
        $response->assertSee('Mi Perfil');
        $response->assertSee('Wilson Romero');
    }

    /**
     * Test non-admin user cannot access admin dashboard.
     */
    public function test_non_admin_cannot_access_admin_dashboard(): void
    {
        $client = User::create([
            'id_rol' => Rol::CLIENTE,
            'nombre' => 'Cliente',
            'apellido' => 'Prueba',
            'correo' => 'cliente@example.com',
            'password' => 'secret123',
            'activo' => true,
            'fecha_registro' => now(),
        ]);

        $response = $this->actingAs($client)->get('/admin/dashboard');

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('error');
    }

    /**
     * Test admin user can access admin dashboard.
     */
    public function test_admin_can_access_admin_dashboard(): void
    {
        $admin = User::create([
            'id_rol' => Rol::ADMIN,
            'nombre' => 'Admin',
            'apellido' => 'Principal',
            'correo' => 'admin@example.com',
            'password' => 'secret123',
            'activo' => true,
            'fecha_registro' => now(),
        ]);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Panel de Administración');
    }
}
