<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetFkForDetailAlat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_alat', function (Blueprint $table) {
            $table->unsignedInteger('lokasi_id')->change();
            $table->foreign('lokasi_id')->references('id')->on('lokasi_penyimpanan')->onDelete('restrict');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_alat', function (Blueprint $table) {
            //
        });
    }
}
