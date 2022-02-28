<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBookingPengembalian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_pengembalian', function (Blueprint $table) {
            $table->id();
            $table->date('appointment_date');
            $table->string('nim_mahasiswa')->nullable('')->unsigned();
            $table->string('nip_staff')->nullable('')->unsigned();
            $table->bigInteger('peminjaman_id')->nullable()->unsigned();
            $table->boolean('is_booking_cancel')->nullable();
            $table->string('booking_notes')->nullable('');
            $table->string('process_by')->nullable(''); 
            $table->softDeletes();
            $table->timestamps();

            // Foreign Key
            $table->foreign('peminjaman_id')->references('id')->on('peminjaman')->onDelete('cascade');
            $table->foreign('nim_mahasiswa')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('nip_staff')->references('nip')->on('staff')->onDelete('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_pengembalian', function (Blueprint $table) {
            //
        });
    }
}
