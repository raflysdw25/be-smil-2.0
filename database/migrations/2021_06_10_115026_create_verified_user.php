<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifiedUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->boolean('is_verified')->default(false);
        });
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->boolean('is_verified')->default(false);
            //
        });
        Schema::create('user_verify', function (Blueprint $table) {
            $table->id();
            $table->string('nim_mahasiswa')->nullable();
            $table->string('nip_staff')->nullable();
            $table->string('token');
            $table->timestamps();

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
        Schema::table('staff', function (Blueprint $table) {
            //
        });
    }
}
