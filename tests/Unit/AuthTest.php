<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Cria um usuário para os testes
        $this->user = User::create([
            'name' => 'Lucas Reolon',
            'email' => 'lucas@example.com',
            'phone' => '123456789',
            'cpf' => '12345678901',
            'password' => Hash::make('senha123'),
        ]);
    }

    public function test_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Lucas Reolon',
            'email' => 'lucas2@example.com',
            'phone' => '123456789',
            'cpf' => '12345678900',
            'password' => 'senha123',
            'password_confirmation' => 'senha123',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['user', 'token']);
    }

    public function test_login()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'lucas@example.com',
            'password' => 'senha123',
        ]);

        $response->assertStatus(200)->assertJsonStructure(['token']);
    }

    public function test_update_user()
    {
        $response = $this->actingAs($this->user, 'api')
            ->putJson('/api/users/' . $this->user->id, [
                'name' => 'John Smith'
            ]);

        $response->assertStatus(200)
            ->assertJson(['name' => 'John Smith']);
    }

    public function test_delete_user()
    {
        $response = $this->actingAs($this->user, 'api')
            ->deleteJson('/api/users/' . $this->user->id);

        $response->assertStatus(204);
    }

    public function test_assign_address()
    {
        $response = $this->actingAs($this->user, 'api')
            ->postJson('/api/users/' . $this->user->id . '/addresses', [
                'logradouro' => 'Rua A',
                'numero' => '123',
                'bairro' => 'Centro',
                'complemento' => 'Apto 101',
                'cep' => '12345678',
            ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['id', 'user_id', 'logradouro', 'numero', 'bairro', 'complemento', 'cep']);
    }

    public function test_update_address()
    {
        $address = Address::create([
            'user_id' => $this->user->id,
            'logradouro' => 'Rua A',
            'numero' => '123',
            'bairro' => 'Centro',
            'complemento' => 'Apto 101',
            'cep' => '12345678',
        ]);

        $response = $this->actingAs($this->user, 'api')
            ->putJson('/api/users/' . $this->user->id . '/addresses/' . $address->id, [
                'logradouro' => 'Rua B',
                'numero' => '456',
                'bairro' => 'Jardim',
                'complemento' => 'Casa',
                'cep' => '87654321',
            ]);

        $response->assertStatus(200)
            ->assertJson(['logradouro' => 'Rua B', 'numero' => '456', 'bairro' => 'Jardim', 'complemento' => 'Casa', 'cep' => '87654321']);
    }

    public function test_delete_address()
    {
        $address = Address::create([
            'user_id' => $this->user->id,
            'logradouro' => 'Rua A',
            'numero' => '123',
            'bairro' => 'Centro',
            'complemento' => 'Apto 101',
            'cep' => '12345678',
        ]);

        $response = $this->actingAs($this->user, 'api')
            ->deleteJson('/api/users/' . $this->user->id . '/addresses/' . $address->id);

        $response->assertStatus(204);
    }
}
