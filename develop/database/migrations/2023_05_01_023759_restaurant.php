<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('restaurant', function (Blueprint $table) {
            $table  -> id();
            $table  -> string('name', 50);
            $table  -> decimal('lat', 10, 8); // precision of 10, with 8 decimal places
            $table  -> decimal('lng', 11, 8); // precision of 11, with 8 decimal places
            $table  -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('restaurant');

    }
};
