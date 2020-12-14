<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldersForAdminNscForUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('holders_for_admin_nsc_for_user', function (Blueprint $table) {
            $table->unsignedBigInteger('nsc_for_user_id');
            $table->foreign('nsc_for_user_id', 'nsc_for_user_id_fk_2786046')->references('id')->on('nsc_for_users')->onDelete('cascade');
            $table->unsignedBigInteger('holders_for_admin_id');
            $table->foreign('holders_for_admin_id', 'holders_for_admin_id_fk_2786046')->references('id')->on('holders_for_admins')->onDelete('cascade');
        });
    }
}
