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
        Schema::create('perangkat_lunaks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('informasi');
            $table->text('deskripsi');
            $table->string('developer');
            $table->foreignId('metode_id');
            $table->foreignId('option_id');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perangkat_lunaks');
    }
};
