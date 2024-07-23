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
        Schema::create('chalet_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('accommodation_id')->constrained('accommodations')->cascadeOnDelete();
            $table->integer('numberOfRooms')->nullable();
            $table->decimal('pricePerNight', 10, 2)->nullable();
            $table->integer('numberOfStars')->nullable();
            $table->text('description')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();
            $table->longText('bookingConditions')->nullable();
            $table->longText('cancellingConditions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chalet_sections');
    }
};
