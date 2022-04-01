<?php

namespace Tests\Feature\Auth;

use App\Models\User; // Tambahkan use model App\Models\User
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    // Trait refresh database agar migration dijalankan
    use RefreshDatabase;

    /** @test */
    public function user_can_register()
    {
        // Kunjungi halaman '/register'
        $this->visit('/register');

        // Submit form register dengan name, email dan password 2 kali
        $this->submitForm('Register', [
            'name'                  => 'John Thor',
            'email'                 => 'username@gmail.net',
            'password'              => 'secret',
            'password_confirmation' => 'secret',
        ]);


        $this->dump();
        $this->dump(session()->all());

        // Lihat halaman ter-redirect ke url '/home' (register sukses).
        $this->seePageIs('/home');

        // Kita melihat halaman tulisan "Dashboard" pada halaman itu.
        $this->seeText('Dashboard');

        // Lihat di database, tabel users, data user yang register sudah masuk
        $this->seeInDatabase('users', [
            'name'  => 'John Thor',
            'email' => 'username@example.net',
        ]);

        // Cek hash password yang tersimpan cocok dengan password yang diinput
        $this->assertTrue(app('hash')->check('secret', User::first()->password));
    }
}
