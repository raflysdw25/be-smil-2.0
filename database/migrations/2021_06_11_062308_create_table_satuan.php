<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSatuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('satuan_jumlah', function (Blueprint $table) {
            $table->id();
            $table->string('satuan_jumlah_name');
            $table->timestamps();
        });

        Schema::table('alat', function (Blueprint $table) {
            $table->unsignedInteger('satuan_id');
            $table->boolean('habis_pakai')->default(false);

            $table->foreign('satuan_id')->references('id')->on('satuan_jumlah')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('satuan_jumlah');
    }
}
