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
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id'); // Unique ID column with auto-increment
            $table->string('lineID', 40)->nullable();
            $table->string('role');
            $table->string('username');
            $table->string('name');
            $table->string('email')->unique()->nullable(); // Make email column unique and nullable
            $table->string('phone', 25)->nullable();
            $table->string('birthday', 25)->nullable();
            $table->string('picture')->nullable();
            $table->string('vat', 12)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
