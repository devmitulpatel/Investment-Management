<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKisanVikarPatraForUserNomineesForAdminPivotTable extends Migration
{
    public function up()
    {
        Schema::create('kisan_vikar_patra_for_user_nominees_for_admin', function (Blueprint $table) {
            $table->unsignedBigInteger('kisan_vikar_patra_for_user_id');
            $table->foreign('kisan_vikar_patra_for_user_id', 'kisan_vikar_patra_for_user_id_fk_2786105')->references('id')->on('kisan_vikar_patra_for_users')->onDelete('cascade');
            $table->unsignedBigInteger('nominees_for_admin_id');
            $table->foreign('nominees_for_admin_id', 'nominees_for_admin_id_fk_2786105')->references('id')->on('nominees_for_admins')->onDelete('cascade');
        });
    }
}
