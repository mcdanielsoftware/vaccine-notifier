<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypesToSitesTable extends Migration
{

    public function up(): void
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->boolean('moderna_available')->after('appointments_available_2nd_dose_only')->default(0);
            $table->boolean('pfizer_available')->after('moderna_available')->default(0);
            $table->boolean('jj_available')->after('pfizer_available')->default(0);
        });
    }

}
