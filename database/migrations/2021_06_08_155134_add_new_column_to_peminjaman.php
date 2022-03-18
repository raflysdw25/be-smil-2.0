<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToPeminjaman extends Migration
{
    // Perlu Dihapus

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->date('created_date')->default(\Carbon\Carbon::now())->change();
        });

        Schema::table('detail_peminjaman', function (Blueprint $table) {
            $table->dropForeign(['barcode_alat']);
            $table->dropForeign(['pjm_id']);
            $table->foreign('barcode_alat')->references('barcode_alat')->on('detail_alat')->onDelete('cascade');
            $table->foreign('pjm_id')->references('id')->on('peminjaman')->onDelete('cascade');
        });
        Schema::table('laporan_kerusakan', function (Blueprint $table) {
            $table->dropForeign(['barcode_alat']);
            $table->foreign('barcode_alat')->references('barcode_alat')->on('detail_alat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            //
        });
    }
}
