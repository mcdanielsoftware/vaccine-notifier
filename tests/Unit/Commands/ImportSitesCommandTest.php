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
    public function it_import_sites_dispatches_jobs(): void
    {
        Queue::fake();

        Artisan::call('import:sites');

        Queue::assertPushed(StateImportJob::class, 51);
    }
}
