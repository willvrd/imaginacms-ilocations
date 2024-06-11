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
        Schema::create('ilocations__geozonables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('geozone_id')->unsigned();
            $table->foreign('geozone_id')->references('id')->on('ilocations__geozones')->onDelete('cascade');
            $table->integer('geozonable_id');
            $table->string('geozonable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ilocations__geozonables');
    }
};
