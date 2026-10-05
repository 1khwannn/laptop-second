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
            Schema::create('laptop_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
            $table->string('model_name');
            $table->string('processor');
            $table->string('ram');
            $table->string('storage');
            $table->text('condition_description');
            $table->decimal('expected_price', 12, 2);
            $table->decimal('admin_offer_price', 12, 2)->nullable();
            $table->enum('status', ['pending', 'negotiating', 'accepted', 'rejected', 'completed'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laptop_offers');
    }
};
