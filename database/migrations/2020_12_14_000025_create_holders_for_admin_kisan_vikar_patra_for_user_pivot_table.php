<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldersForAdminKisanVikarPatraForUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('holders_for_admin_kisan_vikar_patra_for_user', function (Blueprint $table) {
            $table->unsignedBigInteger('kisan_vikar_patra_for_user_id');
            $table->foreign('kisan_vikar_patra_for_user_id', 'kisan_vikar_patra_for_user_id_fk_2780849')->references('id')->on('kisan_vikar_patra_for_users')->onDelete('cascade');
            $table->unsignedBigInteger('holders_for_admin_id');
            $table->foreign('holders_for_admin_id', 'holders_for_admin_id_fk_2780849')->references('id')->on('holders_for_admins')->onDelete('cascade');
        });
    }
}
