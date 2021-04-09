<?php

namespace Tests\Feature;

use App\Jobs\StateImportJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ImportSitesCommandTest extends TestCase
{
    /** @test */
    public function it_dispatches_state_import_job_for_each_state(): void
    {
        Queue::fake();

        Artisan::call('import:sites');

        Queue::assertPushed(StateImportJob::class, 51);
    }
}
