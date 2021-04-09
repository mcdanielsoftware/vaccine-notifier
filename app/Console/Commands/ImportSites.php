<?php

namespace App\Console\Commands;

use App\Jobs\StateImportJob;
use Illuminate\Console\Command;

class ImportSites extends Command
{
    protected string $signature = 'import:sites';
    protected string $description = 'Imports vaccine sites for every state in the config';

    public function handle(): int
    {
        $this->info('Starting import....');
        foreach (config('vaccine-notifier.states') as $state) {
            $this->info(sprintf('Dispatching job for %s sites', $state));
            StateImportJob::dispatch($state);
        }
        $this->info('All states dispatched!');
    }
}
