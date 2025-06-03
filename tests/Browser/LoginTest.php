<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;


class LoginTest extends DuskTestCase
{
   

    public function testSuccessfulLoginAdmin(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/') // Mengunjungi halaman login
                    ->pause(2000)
                    ->assertSee('Login')
                    ->press('Login')
                    ->pause(2000)
                    ->assertPathIs('/')
                    ->type('username', 'admin2') // Mengisi field username
                    ->type('password', 'admin2') // Mengisi field password
                    ->press('Login')// Klik tombol Login
                    ->pause(2000)
                    ->assertPathIs('/admin/home') // Redirect ke homepage untuk customer
                    ->pause(1000);
        });
    }

}