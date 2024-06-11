<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ilocations__cities', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields

            $table->text('code', 6);

            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('ilocations__countries')->onDelete('cascade');

            $table->integer('province_id')->unsigned();
            $table->foreign('province_id')->references('id')->on('ilocations__provinces')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('ilocations__cities', function (Blueprint $table) {
            $table->dropForeign([
                'province_id',
            ]);
            $table->dropForeign([
                'country_id',
            ]);
        });
        Schema::dropIfExists('ilocations__cities');
    }
};
