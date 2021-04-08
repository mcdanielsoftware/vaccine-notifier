<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{

    public function up(): void
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->double('lat');
            $table->double('long');
            $table->string('url');
            $table->string('name');
            $table->string('city');
            $table->string('state');
            $table->string('address');
            $table->string('provider');
            $table->string('time_zone');
            $table->string('postal_code');
            $table->json('appointments');
            $table->string('provider_brand');
            $table->boolean('carries_vaccine');
            $table->json('appointment_types');
            $table->unsignedBigInteger('provider_brand_id');
            $table->string('provider_brand_name');
            $table->string('provider_location_id');
            $table->boolean('appointments_available');
            $table->json('appointment_vaccine_types');
            $table->dateTime('appointments_last_fetched');
            $table->dateTime('appointments_last_modified');
            $table->boolean('appointments_available_all_doses');
            $table->boolean('appointments_available_2nd_dose_only');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
}
