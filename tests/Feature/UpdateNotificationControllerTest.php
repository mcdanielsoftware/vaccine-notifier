<?php

namespace Tests\Feature;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\TestCase;

class UpdateNotificationControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_edits_the_notification()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $user = User::factory()->create();


        $notification = Notification::create([
            'user_id' => $user->id,
            'zip' => '29624',
            'radius' => 25,
            'lat' => 35,
            'long' => 35,
        ]);
        $updates = [
            'zip' => '21703',
            'radius' => 15,
        ];

        $response = $this->actingAs($user)->put(route('notification.update', [$notification]), $updates);

        $response->assertStatus(302);

        $notification->refresh();
        $this->assertSame($updates, Arr::only($notification->toArray(), ['zip', 'radius']));
    }

    /** @test */
    public function it_will_not_allow_you_to_update_a_notification_that_is_not_yours(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $notification1 = Notification::factory()->create(['user_id' => $user1->id]);
        $notification2 = Notification::create([
            'user_id' => $user2->id,
            'zip' => '29624',
            'radius' => 25,
            'lat' => 35,
            'long' => 100,
        ]);
        $updates = [
            'zip' => '21703',
            'radius' => 15,
        ];

        $response = $this->actingAs($user1)->put(route('notification.delete', [$notification2]), $updates);

        $response->assertStatus(403);

        $this->assertDatabaseHas('notifications',$notification2->toArray());
    }
}
