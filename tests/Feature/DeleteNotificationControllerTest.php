<?php

namespace Tests\Feature;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteNotificationControllerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_notification(): void
    {

        $user = User::factory()->create();

        $notification = Notification::factory()->create(['user_id' => $user->id]);


        $response = $this->actingAs($user)->delete(route('notification.delete', [$notification]));

        $response->assertStatus(302);

        $this->assertDeleted('notifications', ['id' => $notification->id]);

    }

    /** @test */
    public function it_will_not_allow_you_to_delete_a_notification_that_is_not_yours(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $notification1 = Notification::factory()->create(['user_id' => $user1->id]);
        $notification2 = Notification::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($user1)->delete(route('notification.delete', [$notification2]));

        $response->assertStatus(403);

        $this->assertDatabaseHas('notifications', ['id' => $notification2->id]);
    }
}
