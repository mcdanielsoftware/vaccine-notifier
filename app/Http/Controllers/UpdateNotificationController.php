<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateNotificationRequest;
use App\Models\Notification;

class UpdateNotificationController extends Controller
{
    public function __invoke(UpdateNotificationRequest $request, Notification $notification)
    {
        $notification->update($request->validated());
        return redirect()->route('dashboard')->with('message', 'Notification was successfully updated.');
    }
}
