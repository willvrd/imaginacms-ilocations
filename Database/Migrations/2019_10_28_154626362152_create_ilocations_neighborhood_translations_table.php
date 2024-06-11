<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ilocations__neighborhood_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->string('name');
            $table->integer('neighborhood_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['neighborhood_id', 'locale'], 'neighborhood_neighborhood_id_locale_unique');
            $table->foreign('neighborhood_id')->references('id')->on('ilocations__neighborhoods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ilocations__neighborhood_translations', function (Blueprint $table) {
            $table->dropForeign(['neighborhood_id']);
        });
        Schema::dropIfExists('ilocations__neighborhood_translations');
    }
};
