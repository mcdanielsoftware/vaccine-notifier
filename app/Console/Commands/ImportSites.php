<?php

namespace App\Console\Commands;

use App\Jobs\QueryAllNotifications;
use App\Jobs\StateImportJob;
use App\Models\Notification;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

class ImportSites extends Command
{
    protected $signature = 'import:sites';
    protected $description = 'Imports vaccine sites for every state in the config';

    public function handle(): void
    {
        if(!Notification::count()){
            return;
        }
        $this->info('Starting import....');
        $jobs = [];
        foreach (config('vaccine-notifier.states') as $state) {
            $this->info(sprintf('Dispatching job for %s sites', $state));
            $jobs[] = new StateImportJob($state);
        }
        Bus::batch($jobs)->then(function (Batch $batch) {
            QueryAllNotifications::dispatch();
        })->dispatch();
        $this->info('All states dispatched!');
    }
}
