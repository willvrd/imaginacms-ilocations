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
        Schema::table('ilocations__country_translations', function (Blueprint $table) {
            $table->string('full_name')->default('')->nullable()->change();
        });

        Schema::table('ilocations__countries', function (Blueprint $table) {
            $table->string('currency')->default('')->nullable()->change();
            $table->string('currency_symbol')->default('')->nullable()->change();
            $table->string('currency_code')->default('')->nullable()->change();
            $table->string('currency_sub_unit')->default('')->nullable()->change();
            $table->string('region_code')->default('')->nullable()->change();
            $table->string('sub_region_code')->default('')->nullable()->change();
            $table->string('iso_2')->default('')->nullable()->change();
            $table->string('iso_3')->default('')->nullable()->change();
        });

        Schema::table('ilocations__provinces', function (Blueprint $table) {
            $table->string('iso_2')->default('')->nullable()->change();
        });
        Schema::table('ilocations__cities', function (Blueprint $table) {
            $table->string('code')->default('')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
