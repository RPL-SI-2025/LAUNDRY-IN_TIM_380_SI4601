<?php

namespace Database\Factories;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OutletFactory extends Factory
{
    protected $model = Outlet::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'nama_outlet' => $this->faker->company,
            'alamat_outlet' => $this->faker->address,
            'deskripsi_outlet' => $this->faker->paragraph,
            'layanan_laundry' => $this->faker->randomElement(['Regular, Express', 'Regular, Express, Premium']),
            'nomor_layanan' => $this->faker->phoneNumber,
            'image' => 'outlets/default.jpg',
            'layanan_detail' => json_encode([
                [
                    'nama' => 'Regular Laundry',
                    'deskripsi' => '3 hari pengerjaan'
                ],
                [
                    'nama' => 'Express Laundry',
                    'deskripsi' => '1 hari pengerjaan'
                ]
            ])
        ];
    }
}