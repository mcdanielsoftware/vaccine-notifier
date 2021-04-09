<?php

namespace App\Jobs;

use App\Models\Notification;
use App\Models\Site;
use App\Notifications\AppoinmentsAvailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class QueryAllNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        Notification::each(function($n){
           $sites = Site::whereWithinDistance($n->long, $n->lat, $n->radius)
                ->where('appointments_available', true)
                ->get();

           if($sites->isNotEmpty()){
                $n->user->notify(new AppoinmentsAvailable($sites));
                $n->delete();
           }
        });
    }
}
