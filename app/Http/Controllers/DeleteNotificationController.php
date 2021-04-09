<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class DeleteNotificationController extends Controller
{
    public function __invoke(Notification $notification)
    {
        if(auth()->id() != $notification->user_id){
            return response('Forbidden', 403);
        }
        $notification->delete();
        return redirect()->route('dashboard')->with('message', 'Notification was successfully deleted.');
    }
}
