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
        Schema::create('meals', function (Blueprint $table) {
            $table  -> integer('id')	    -> autoIncrement();
            $table  -> integer ('rid')               -> default(0);
            $table  -> string ('name')                              -> nullable();
            $table  -> smallInteger ('price')                       -> nullable();
            $table  -> smallInteger ('isVeg')        -> default(0);
            $table  -> smallInteger ('category')     -> default(0);
            $table  -> smallInteger ('allergic')     -> default(0);
            $table  -> integer ('calorie')                          -> nullable();
            $table  -> timestamps()                  ;
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('meals');

    }
};
