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
            Schema::create('laptops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('serial_number')->nullable()->unique();
            $table->string('processor');
            $table->string('ram');
            $table->string('storage');
            $table->string('vga')->nullable();
            $table->string('screen_size')->nullable();
            $table->string('condition_grade')->default('A');
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->enum('status', ['available', 'booked', 'sold'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laptops');
    }
};
