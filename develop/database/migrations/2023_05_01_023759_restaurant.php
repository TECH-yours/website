<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('restaurant', function (Blueprint $table) {
            $table  -> id()	    -> autoIncrement();
            $table  -> string('name', 50);
            $table  -> decimal('lat', 10, 8); // precision of 10, with 8 decimal places
            $table  -> decimal('lng', 11, 8); // precision of 11, with 8 decimal places
            $table  -> string('area', 10)               -> nullable();
            $table  -> string('address', 30)            -> nullable();
            $table  -> string('tel', 15)                -> nullable();
            $table  -> string('email', 50)              -> nullable();
            $table  -> string('google_map_url', 255)    -> nullable();
            $table  -> string('thumbnailImageUrl', 255) -> default(env("URL") . "/images/logo.png");
            $table  -> string('note', 255)              -> nullable();
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
