<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Outlet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class OutletTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    public function test_user_can_create_outlet()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $outletData = [
            'nama_outlet' => $this->faker->company,
            'alamat_outlet' => $this->faker->address,
            'deskripsi_outlet' => $this->faker->paragraph,
            'layanan_laundry' => 'Regular, Express',
            'nomor_layanan' => $this->faker->phoneNumber,
            'image' => UploadedFile::fake()->image('outlet.jpg'),
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

        $response = $this->post(route('input.outlet'), $outletData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('outlets', [
            'nama_outlet' => $outletData['nama_outlet'],
            'alamat_outlet' => $outletData['alamat_outlet'],
        ]);
        Storage::disk('public')->assertExists('outlets/' . $outletData['image']->hashName());
    }

    public function test_user_cannot_create_outlet_with_invalid_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $outletData = [
            'nama_outlet' => '',
            'alamat_outlet' => '',
            'deskripsi_outlet' => '',
            'layanan_laundry' => '',
            'nomor_layanan' => '',
        ];

        $response = $this->post(route('input.outlet'), $outletData);

        $response->assertStatus(422);
        $response->assertSessionHasErrors(['nama_outlet', 'alamat_outlet', 'deskripsi_outlet', 'layanan_laundry', 'nomor_layanan']);
    }

    public function test_user_can_update_outlet_profile()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $outlet = Outlet::factory()->create([
            'user_id' => $user->id
        ]);

        $updateData = [
            'nama_outlet' => 'Updated Outlet Name',
            'alamat_outlet' => 'Updated Address',
            'deskripsi_outlet' => 'Updated Description',
            'layanan_laundry' => 'Updated Services',
            'nomor_layanan' => '1234567890',
            'layanan_detail' => json_encode([
                [
                    'nama' => 'Updated Service',
                    'deskripsi' => 'Updated Description'
                ]
            ])
        ];

        $response = $this->put(route('profile.update'), $updateData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('outlets', [
            'id' => $outlet->id,
            'nama_outlet' => $updateData['nama_outlet'],
            'alamat_outlet' => $updateData['alamat_outlet'],
        ]);
    }

    public function test_user_can_delete_outlet()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $outlet = Outlet::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->delete(route('profile.delete'));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('outlets', [
            'id' => $outlet->id
        ]);
    }

    public function test_user_cannot_access_outlet_without_authentication()
    {
        $response = $this->get(route('input.outlet'));
        $response->assertRedirect('/login');

        $response = $this->get(route('profile'));
        $response->assertRedirect('/login');
    }
}