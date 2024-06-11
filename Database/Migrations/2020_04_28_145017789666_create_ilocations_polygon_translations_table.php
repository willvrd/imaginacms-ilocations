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
        Schema::create('ilocations__polygon_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->integer('polygon_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['polygon_id', 'locale']);
            $table->foreign('polygon_id')->references('id')->on('ilocations__polygons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ilocations__polygon_translations', function (Blueprint $table) {
            $table->dropForeign(['polygon_id']);
        });
        Schema::dropIfExists('ilocations__polygon_translations');
    }
};
