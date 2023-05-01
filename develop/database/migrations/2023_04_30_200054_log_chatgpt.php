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
        Schema::create('log_chatgpt', function (Blueprint $table) {
            $table  -> integer('index')		    -> autoIncrement();
            $table  -> string('UserId', 50);
            $table  -> string('ChatgptId', 50);
            $table  -> longText('userContent')	-> nullable();
            $table  -> longText('gptContent')	-> nullable();
            $table  -> string('note', 50)	    -> nullable();
            $table  -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_chatgpt');
    }
};
