<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetColumnForImport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_alat', function (Blueprint $table) {
            $table->unsignedInteger('lokasi_id')->nullable()->change();
        });
        Schema::table('alat', function (Blueprint $table) {
            $table->unsignedInteger('satuan_id')->nullable()->change();
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
