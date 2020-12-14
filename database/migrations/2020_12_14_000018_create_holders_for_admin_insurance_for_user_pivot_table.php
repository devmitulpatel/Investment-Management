<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldersForAdminInsuranceForUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('holders_for_admin_insurance_for_user', function (Blueprint $table) {
            $table->unsignedBigInteger('insurance_for_user_id');
            $table->foreign('insurance_for_user_id', 'insurance_for_user_id_fk_2786501')->references('id')->on('insurance_for_users')->onDelete('cascade');
            $table->unsignedBigInteger('holders_for_admin_id');
            $table->foreign('holders_for_admin_id', 'holders_for_admin_id_fk_2786501')->references('id')->on('holders_for_admins')->onDelete('cascade');
        });
    }
}
