<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNomineesForAdminNscForUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('nominees_for_admin_nsc_for_user', function (Blueprint $table) {
            $table->unsignedBigInteger('nsc_for_user_id');
            $table->foreign('nsc_for_user_id', 'nsc_for_user_id_fk_2786079')->references('id')->on('nsc_for_users')->onDelete('cascade');
            $table->unsignedBigInteger('nominees_for_admin_id');
            $table->foreign('nominees_for_admin_id', 'nominees_for_admin_id_fk_2786079')->references('id')->on('nominees_for_admins')->onDelete('cascade');
        });
    }
}
