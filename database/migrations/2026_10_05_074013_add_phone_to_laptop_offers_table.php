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
    Schema::table('laptop_offers', function (Blueprint $table) {
        $table->string('phone_number')->nullable()->after('model_name');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laptop_offers', function (Blueprint $table) {
            //
        });
    }
};
