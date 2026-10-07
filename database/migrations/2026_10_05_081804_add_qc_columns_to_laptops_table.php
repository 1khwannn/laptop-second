<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        public function up()
        {
            Schema::table('laptops', function (Blueprint $table) {
                $table->string('battery_health')->default('Normal (85%)');
                $table->string('screen_condition')->default('Mulus No Dot Pixel');
                $table->string('keyboard_status')->default('Berfungsi Normal 100%');
                $table->string('physical_grade')->default('Grade A (95% Mulus)');
                $table->text('qc_notes')->nullable();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laptops', function (Blueprint $table) {
            //
        });
    }
};
