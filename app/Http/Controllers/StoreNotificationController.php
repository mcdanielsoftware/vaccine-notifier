<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Models\Notification;
use App\Models\Zipcode;

class StoreNotificationController extends Controller
{

    public function __invoke(StoreNotificationRequest $request)
    {
        $zip = Zipcode::where('zipcode', $request->input('zip'))->firstOrFail();
        $notification = new Notification();
        $notification->zip = $zip->zipcode;
        $notification->lat = $zip->lat;
        $notification->long = $zip->long;
        $notification->radius = $request->input('radius');
        $notification->user_id = auth()->id();
        $notification->save();
        return redirect()->route('dashboard')->with('message', 'Notification was successfully created.');;
    }
}
