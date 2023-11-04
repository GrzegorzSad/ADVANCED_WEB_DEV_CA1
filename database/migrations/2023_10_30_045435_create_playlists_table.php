<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('playlists', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('user');
        $table->text('description')->nullable();
        $table->string('image_url')->nullable();
        $table->date('creation_date')->default(now()); // Set a default value
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playlists');
    }
};