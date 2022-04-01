<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function registered_user_can_login()
    {
        // Kita memiliki 1 user terdaftar
        $user = User::factory()->create([
            'email'    => 'username@example.net',
            'password' => bcrypt('secret'),
        ]);

        // Kunjungi halaman '/login'
        $this->visit('/login');

        // Submit form login dengan email dan password yang tepat
        $this->submitForm('Login', [
            'email'    => 'username@example.net',
            'password' => 'secret',
        ]);

        // Lihat halaman ter-redirect ke url '/home' (login sukses).
        $this->seePageIs('/home');

        // Kita melihat halaman tulisan "Dashboard" pada halaman itu.
        $this->seeText('Dashboard');
    }

    /** @test */
    public function logged_in_user_can_logout()
    {
        // Kita memiliki 1 user terdaftar
        $user = User::factory()->create([
            'email'    => 'username@example.net',
            'password' => bcrypt('secret'),
        ]);

        // Login sebagai user tersebut
        $this->actingAs($user);

        // Kunjungi halaman '/home'
        $this->visit('/home');

        // Buat post request ke url '/logout'
        $this->post('/logout');

        // Kunjungi (lagi) halaman '/home'
        $this->visit('/home');

        // User ter-redirect ke halaman '/login'
        $this->seePageIs('/login');
    }
}
