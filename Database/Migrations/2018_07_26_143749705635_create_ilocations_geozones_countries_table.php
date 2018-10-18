<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIlocationsGeozonesCountriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('ilocations__geozones_countries', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');

      $table->integer('geozone_id')->unsigned();
      $table->foreign('geozone_id')->references('id')->on('ilocations__geozones')->onDelete('cascade');
      
      $table->string('iso_2_country');
      $table->string('iso_2_zone');
      $table->timestamps();
    });
  }
  
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('ilocations__geozones_countries', function (Blueprint $table) {
      $table->dropForeign([
        'geozone_id',
      ]);
    });
    Schema::dropIfExists('ilocations__geozones_countries');
  }
}
