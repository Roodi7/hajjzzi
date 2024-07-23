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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->default('company name')->nullable();
            $table->boolean('show_recipient_name')->default(0)->nullable();
            $table->string('phone')->default('0987654321')->nullable();
            $table->string('favicon')->default('assets/images/QUICK.png')->nullable();
            $table->string('logo')->default('assets/images/QUICK.png')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
