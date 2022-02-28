<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetColumnPeminjamBooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_pengembalian', function (Blueprint $table) {
            $table->string('nim_mahasiswa')->nullable()->unsigned()->change();
            $table->string('nip_staff')->nullable()->unsigned()->change();
            $table->string('booking_notes')->nullable()->change();
            $table->string('process_by')->nullable()->change(); 
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
