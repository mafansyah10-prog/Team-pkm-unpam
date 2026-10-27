<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\PackagingGroup;
use App\Models\PackagingItem;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PackagingAdminTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_public_packaging_guide_page_renders_successfully()
    {
        $response = $this->get(route('packaging.guide'));
        $response->assertStatus(200);
        $response->assertViewHas('packagingGroups');
    }

    public function test_admin_packaging_page_requires_auth()
    {
        $response = $this->get(route('admin.packaging'));
        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_view_packaging_management_page()
    {
        $admin = User::first() ?? User::factory()->create();

        $response = $this->actingAs($admin)->get(route('admin.packaging'));
        $response->assertStatus(200);
        $response->assertViewHas('items');
        $response->assertViewHas('groups');
    }

    public function test_admin_can_store_update_and_delete_packaging_item()
    {
        $admin = User::first() ?? User::factory()->create();
        $group = PackagingGroup::first();

        // 1. Create
        $storeResponse = $this->actingAs($admin)->post(route('admin.packaging.store'), [
            'group_id'   => $group->id,
            'code'       => 'TEST',
            'ceisa'      => 'Test Container',
            'title'      => 'Kontainer Tes (Test Container)',
            'desc'       => 'Deskripsi pengujian kemasan otomatis',
            'example'    => '5 TEST',
            'tips'       => 'Pastikan tersegel rapi',
            'is_active'  => 1,
        ]);

        $storeResponse->assertRedirect();
        $this->assertDatabaseHas('packaging_items', [
            'code'  => 'TEST',
            'title' => 'Kontainer Tes (Test Container)',
        ]);

        $item = PackagingItem::where('code', 'TEST')->first();
        $this->assertNotNull($item);

        // 2. Update
        $updateResponse = $this->actingAs($admin)->post(route('admin.packaging.update', $item->id), [
            'group_id'   => $group->id,
            'code'       => 'TEST2',
            'ceisa'      => 'Test Container Updated',
            'title'      => 'Kontainer Tes Diperbarui',
            'desc'       => 'Deskripsi yang sudah diedit',
            'example'    => '10 TEST2',
            'tips'       => 'Tips baru',
            'is_active'  => 1,
        ]);

        $updateResponse->assertRedirect();
        $this->assertDatabaseHas('packaging_items', [
            'id'    => $item->id,
            'code'  => 'TEST2',
            'title' => 'Kontainer Tes Diperbarui',
        ]);

        // 3. Delete
        $deleteResponse = $this->actingAs($admin)->delete(route('admin.packaging.delete', $item->id));
        $deleteResponse->assertRedirect();
        $this->assertDatabaseMissing('packaging_items', [
            'id' => $item->id,
        ]);
    }
}
