<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class VoucherTest extends DuskTestCase
{
    public function testSuccessfulVoucherAdmin(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/') // Login terlebih dahulu
                    ->pause(2000)
                    ->assertSee('Login')
                    ->press('Login')
                    ->pause(2000)
                    ->assertPathIs('/')
                    ->type('username', 'admin1')
                    ->type('password', 'admin12345')
                    ->press('Login')
                    ->pause(2000)
                    ->assertPathIs('/admin/home')
                    ->pause(1000)
                    // Mulai test voucher
                    ->clickLink('Voucher') // Klik menu voucher
                    ->pause(2000)
                    ->assertPathIs('/admin/vouchers')
                    ->assertSee('Tambah Voucher')
                    ->clickLink('Tambah Voucher') // Klik tombol tambah voucher
                    ->pause(2000)
                    ->assertPathIs('/admin/vouchers/create')
                    // Debug: Ambil screenshot sebelum mengisi form
                    ->screenshot('before-form-fill')
                    // Isi form dengan data yang valid
                    ->type('code', 'AHRI2024') // Gunakan kode yang unik
                    ->type('description', 'Diskon 1000')
                    ->type('discount_amount', '1000')
                    // Cara yang benar untuk mengisi datetime-local input
                    ->click('input[name="valid_until"]') // Klik field datetime
                    ->keys('input[name="valid_until"]', '05132026') // MM/DD/YYYY format
                    ->keys('input[name="valid_until"]', '{tab}') // Pindah ke time part
                    ->keys('input[name="valid_until"]', '0130') // HH:MM format
                    ->keys('input[name="valid_until"]', 'PM') // AM/PM
                    ->type('max_uses', '100')
                    ->check('is_active') // Checkbox untuk status aktif
                    // Debug: Screenshot setelah mengisi form
                    ->screenshot('after-form-fill')
                    // Submit form
                    ->press('Buat Voucher') // Klik tombol submit
                    ->pause(5000) // Beri waktu lebih untuk proses
 
                    // Tunggu redirect dengan timeout lebih lama
                    ->waitForLocation('/admin/vouchers', 10)
                    ->assertSee('Voucher berhasil dibuat!'); // Sesuai dengan controller
        });
    }
}