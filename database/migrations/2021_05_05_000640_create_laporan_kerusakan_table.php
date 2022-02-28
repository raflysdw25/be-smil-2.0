<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanKerusakanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_kerusakan', function (Blueprint $table) {
            $table->id();
            $table->date('report_date')->default(\Carbon\Carbon::now());
            $table->string('barcode_alat');
            $table->string('nim_mahasiswa')->nullable();
            $table->string('nip_staff')->nullable();
            $table->integer('report_status')->default(1); // 1 : Menunggu Tindakan, 2 : Diperbaiki, 3: Tidak Diperbaiki
            $table->longText('chronology')->nullable();
            $table->date('report_action_date')->nullable();
            $table->longText('report_notes')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('laporan_kerusakan');
    }
}
