<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetFkDetailPeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_peminjaman', function (Blueprint $table) {
            $table->dropForeign('detail_peminjaman_pjm_id_foreign');
            $table->dropForeign('detail_peminjaman_alat_id_foreign');

            $table->foreign('pjm_id')->references('id')->on('peminjaman')->onDelete('cascade');
            $table->foreign('alat_id')->references('id')->on('alat')->onDelete('restrict');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
