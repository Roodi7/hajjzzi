<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->string('location');
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('capacity')->nullable();
            $table->string('price')->nullable();
            $table->string('rating')->nullable();
            $table->string('phone')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->boolean('availability')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};
