<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Hash;

class LoginTest extends DuskTestCase
{
    /**
     * Test login dan redirect ke halaman input outlet
     */
    public function testUserCanLoginAndRedirectedToInputOutlet()
    {
        // Membuat user dummy
        $user = User::create([
            'username' => 'admin',
            'telepon' => '08123456789',
            'alamat' => 'Jl. Testing',
            'password' => Hash::make('admin123'),
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->type('username', 'admin') // Sesuai dengan field pada form login
                    ->type('password', 'admin123')
                    ->press('@login-button') // Harus sesuai dengan atribut dusk di blade
                    ->assertPathIs('/input-outlet'); // Sesuaikan dengan redirect setelah login
        });

        // Hapus user setelah test (opsional)
        $user->delete();
    }
}
