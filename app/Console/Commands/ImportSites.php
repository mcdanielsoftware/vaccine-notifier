<?php

namespace App\Console\Commands;

use App\Jobs\StateImportJob;
use Illuminate\Console\Command;

class ImportSites extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:sites';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports vaccine sites for every state in the config';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting import....');
        foreach (config('vaccine-notifier.states') as $state) {
            $this->info(sprintf('Dispatching job for %s sites', $state));
            StateImportJob::dispatch($state);
        }
        $this->info('All states dispatched!');
    }
}
