<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class OutletTest extends DuskTestCase
{

    public function testEditProfilOutlet(): void
    {
        $user = User::first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/profile')
                    ->pause(1000)
                    ->press('Edit Profile')
                    ->pause(1000)
                    ->assertPathIs('/profile')
                    ->pause(1000)
                    ->type('layanan_laundry', 'Cuci Kering dan seterika')
                    ->type('deskripsi_outlet', 'Express')
                    //->select('layanan_laundry', 'Express')
                    ->pause(1000)
                    ->press('Simpan')
                    ->pause(1000)
                    ->waitForText('Data outlet berhasil diperbarui')
                    ->assertSee('Data outlet berhasil diperbarui')
                    ->pause(1000);
        });
    }

    public function testHapusOutlet(): void
{
    $user = \App\Models\User::first();

    $this->browse(function (Browser $browser) use ($user) {
        $browser->loginAs($user)
                ->visit('/profile')
                ->pause(1000)
                ->waitForText('Hapus Outlet', 5)
                ->press('Hapus Outlet') // alternatif: ->click('.btn-danger')
                ->pause(1000)
                ->acceptDialog()
                ->waitForText('Outlet berhasil dihapus', 5)
                ->assertPathIs('/profile')
                ->assertSee('Outlet berhasil dihapus');
    });
}


}
