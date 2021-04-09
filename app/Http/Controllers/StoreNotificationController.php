<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Models\Notification;

class StoreNotificationController extends Controller
{

    public function __invoke(StoreNotificationRequest $request)
    {
        Notification::create(array_merge($request->validated(), ['user_id' => auth()->id()]));
        return redirect()->route('dashboard')->with('message', 'Notification was successfully created.');;
    }
}
