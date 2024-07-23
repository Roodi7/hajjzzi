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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->text('hotels_description')->nullable();
            $table->string('hotels_image')->nullable();
            $table->text('chalets_description')->nullable();
            $table->string('chalets_image')->nullable();
            $table->text('halls_description')->nullable();
            $table->string('halls_image')->nullable();
            $table->text('appartments_description')->nullable();
            $table->string('appartments_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
