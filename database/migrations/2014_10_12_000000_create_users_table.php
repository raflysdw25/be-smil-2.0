<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default(bcrypt('admin'));
            $table->date('start_active_period')->default(\Carbon\Carbon::now());
            $table->date('end_active_period');
            $table->boolean('first_login')->default(true);
            $table->unsignedInteger('jabatan_id');
            $table->rememberToken()->nullable();
            
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
        Schema::dropIfExists('users');
    }
}
