<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;


class RegisterTest extends DuskTestCase
{
   

    public function testSuccessfullRegister(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register') // Mengunjungi halaman login
                    ->pause(2000)
                    ->assertSee('Register')
                    ->press('Register')
                    ->pause(2000)
                    ->assertPathIs('/register')
                    ->type('username', 'admin') // Mengisi field username
                    ->type('telepon', '082139688455')
                    ->type('alamat', 'Malang')
                    ->type('password', 'admin1') // Mengisi field password
                    ->press('Register')// Klik tombol Login
                    ->pause(2000)
                    ->assertPathIs('/'); // Redirect ke homepage untuk customer
        });
    }

}