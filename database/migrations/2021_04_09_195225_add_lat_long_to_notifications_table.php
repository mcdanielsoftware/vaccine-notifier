<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLatLongToNotificationsTable extends Migration
{

    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->decimal('lat', 10, 8);
            $table->decimal('long', 11, 8);
        });
    }


    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn('lat');
            $table->dropColumn('long');
        });
    }
}
