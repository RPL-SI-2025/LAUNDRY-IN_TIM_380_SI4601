<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TambahOutletTest extends DuskTestCase
{

    public function testTambahOutlet(): void
{
    $user = User::first();

    $this->browse(function (Browser $browser) use ($user) {
        $browser->loginAs($user)
                ->visit('/input-outlet')
                ->attach('image', realpath('C:/laragon/www/LAUNDRY-IN_TIM_380_SI4601/public/dummy/foto_outlet.jpeg'))
                ->type('nama_outlet', 'Laundry Kilat Sejahtera')
                ->type('alamat_outlet', 'Jl. Melati No. 123, Bandung')
                ->type('nomor_layanan', '081234567890')
                ->type('layanan_laundry', 'Cuci Kering')
                ->type('deskripsi_outlet', 'Outlet laundry tercepat dan terpercaya di Bandung.')
                ->press('Tambahkan Outlet Laundry')
                ->pause(2000)
                ->assertPathIs('/admin/home'); // ganti sesuai redirect yang benar
    });
}

}
