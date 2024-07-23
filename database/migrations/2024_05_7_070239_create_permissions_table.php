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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('city_index')->default(0);
            $table->boolean('city_create')->default(0);
            $table->boolean('city_edit')->default(0);
            $table->boolean('city_delete')->default(0);
            $table->boolean('accomodation_index')->default(0);
            $table->boolean('accomodation_create')->default(0);
            $table->boolean('accomodation_edit')->default(0);
            $table->boolean('accomodation_delete')->default(0);
            $table->boolean('feature_index')->default(0);
            $table->boolean('feature_create')->default(0);
            $table->boolean('feature_edit')->default(0);
            $table->boolean('feature_delete')->default(0);
            $table->boolean('term_index')->default(0);
            $table->boolean('term_create')->default(0);
            $table->boolean('term_edit')->default(0);
            $table->boolean('term_delete')->default(0);
            $table->boolean('manage_users')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
