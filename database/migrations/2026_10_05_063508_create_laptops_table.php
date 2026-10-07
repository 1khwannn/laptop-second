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
    $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
    $table->string('title');
    $table->string('slug')->unique();
    $table->string('serial_number')->unique();
    $table->string('processor');
    $table->string('ram');
    $table->string('storage');
    $table->string('gpu')->nullable();
    $table->decimal('buy_price', 12, 2);
    $table->decimal('refurbish_cost', 12, 2)->default(0);
    $table->decimal('price', 12, 2);
    $table->string('condition_grade');
    $table->text('description')->nullable();
    $table->string('battery_health')->nullable();
    $table->string('screen_condition')->nullable();
    $table->string('keyboard_status')->nullable();
    $table->string('image')->nullable();
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
