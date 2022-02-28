<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLogPeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('peminjaman_id')->unsigned();
            $table->string('action'); //Created, Daftar Alat dipinjam, Persetujuan Peminjaman, Pengembalian Alat,
            $table->string('created_by')->nullable();
            $table->timestamps();

            $table->foreign('peminjaman_id')->references('id')->on('peminjaman')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_peminjaman');
    }
}
