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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100);
            $table->string('email')->unique();
            $table->string('pwd');
            $table->string('phone', 20);

            // Unix timestamp values
            $table->unsignedBigInteger('created');
            $table->unsignedBigInteger('updated');

            // Optional: needed for Laravel's "Remember Me" login feature
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
        {
            Schema::dropIfExists('users');
        }
};
