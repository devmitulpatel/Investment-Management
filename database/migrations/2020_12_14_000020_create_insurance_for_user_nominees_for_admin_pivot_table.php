<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceForUserNomineesForAdminPivotTable extends Migration
{
    public function up()
    {
        Schema::create('insurance_for_user_nominees_for_admin', function (Blueprint $table) {
            $table->unsignedBigInteger('insurance_for_user_id');
            $table->foreign('insurance_for_user_id', 'insurance_for_user_id_fk_2786502')->references('id')->on('insurance_for_users')->onDelete('cascade');
            $table->unsignedBigInteger('nominees_for_admin_id');
            $table->foreign('nominees_for_admin_id', 'nominees_for_admin_id_fk_2786502')->references('id')->on('nominees_for_admins')->onDelete('cascade');
        });
    }
}
