<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetFkAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alat', function (Blueprint $table) {
            $table->dropForeign('alat_jenis_alat_id_foreign');
            $table->dropForeign('alat_asal_pengadaan_id_foreign');
            $table->dropForeign('alat_supplier_id_foreign');
            $table->dropForeign('alat_satuan_id_foreign');


            $table->foreign('jenis_alat_id')->references('id')->on('jenis_alat')->onDelete('restrict');
            $table->foreign('asal_pengadaan_id')->references('id')->on('asal_pengadaan')->onDelete('restrict');
            $table->foreign('supplier_id')->references('id')->on('supplier')->onDelete('restrict');
            $table->foreign('satuan_id')->references('id')->on('satuan_jumlah')->onDelete('restrict');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_nip_foreign');
            $table->dropForeign('users_jabatan_id_foreign');

            $table->foreign('nip')->references('nip')->on('staff')->onDelete('restrict');
            $table->foreign('jabatan_id')->references('id')->on('jabatan')->onDelete('restrict');
        });

        
        Schema::table('detail_peminjaman', function (Blueprint $table) {
            $table->dropForeign('detail_peminjaman_pjm_id_foreign');

            $table->foreign('pjm_id')->references('id')->on('peminjaman')->onDelete('restrict');
            
        });
        

        Schema::table('staff', function (Blueprint $table) {
            $table->dropForeign('staff_prodi_id_foreign');
            $table->foreign('prodi_id')->references('id')->on('prodi')->onDelete('set null');
            
        });
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign('mahasiswa_prodi_id_foreign');
            $table->foreign('prodi_id')->references('id')->on('prodi')->onDelete('set null');
        });

        // Schema::table('peminjaman', function (Blueprint $table) {
        //     $table->dropForeign('nim_mahasiswa');
        //     $table->dropForeign('nip_staff');
        //     $table->dropForeign('nip_staff_in_charge');

        //     $table->foreign('nim_mahasiswa')->references('nim')->on('mahasiswa')->onDelete('restrict');
        //     $table->foreign('nip_staff')->references('nip')->on('staff')->onDelete('restrict');
        //     $table->foreign('nip_staff_in_charge')->references('nip')->on('staff')->onDelete('restrict');
        // });

        // Schema::table('laporan_kerusakan', function (Blueprint $table) {
        //     $table->dropForeign('barcode_alat');
        //     $table->foreign('barcode_alat')->references('barcode_alat')->on('detail_alat')->onDelete('restrict');
        // });
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
