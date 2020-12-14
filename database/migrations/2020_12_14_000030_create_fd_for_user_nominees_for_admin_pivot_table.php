<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFdForUserNomineesForAdminPivotTable extends Migration
{
    public function up()
    {
        Schema::create('fd_for_user_nominees_for_admin', function (Blueprint $table) {
            $table->unsignedBigInteger('fd_for_user_id');
            $table->foreign('fd_for_user_id', 'fd_for_user_id_fk_2786534')->references('id')->on('fd_for_users')->onDelete('cascade');
            $table->unsignedBigInteger('nominees_for_admin_id');
            $table->foreign('nominees_for_admin_id', 'nominees_for_admin_id_fk_2786534')->references('id')->on('nominees_for_admins')->onDelete('cascade');
        });
    }
}
