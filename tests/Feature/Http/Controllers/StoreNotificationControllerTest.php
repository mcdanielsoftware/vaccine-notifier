<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreNotificationControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_notification_and_redirects_to_dashboard(): void
    {

        $user = User::factory()->create();
        $data = [
            'zip' => 29624,
            'radius' => 50,
        ];
        $response = $this->actingAs($user)->post(route('notification.store'), $data);

        $response->assertStatus(302);

        $this->assertSame(1, $user->notifications()->count());
        $expected = array_merge($data, ['user_id' => $user->id]);
        $this->assertDatabaseHas('notifications', $expected);
    }

    /** @test */
    public function it_requires_valid_data(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('notification.store'));

        $response->assertStatus(302); // Inertia still redirects on an error

        $this->assertEmpty($user->notifications()->count());
    }

}
