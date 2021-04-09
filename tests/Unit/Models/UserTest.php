<?php

namespace Tests\Unit;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{

    /** @test */
    public function it_can_create_and_delete_notifcation(): void
    {
        $numNotifications = 5;
        $notifications = Notification::factory()->forUser()->count($numNotifications)->create();

        $user = User::with('notifications')->find($notifications[0]->user_id);

        $this->assertEquals($numNotifications, $user->notifications()->count());

        $deleted = Notification::where('user_id', $notifications[0]->user_id)->delete();
        $this->assertEquals($numNotifications, $deleted);

        $user = User::with('notifications')->find($notifications[0]->user_id);
        $this->assertEquals(0, $user->notifications()->count());
    }

    /** @test */
    public function it_cannot_create_duplicate_notifcation(): void
    {
        $notification = Notification::factory()->forUser()->create();
        
        try {
            Notification::create([
                'user_id' => $notification->user_id,
                'zip' => $notification->zip,
            ]);
        } catch (\Exception $e) {
            $this->assertTrue($e instanceof QueryException);
        }

        $user = User::with('notifications')->find($notification->user_id);
        $this->assertEquals(1, $user->notifications()->count());
    }
}