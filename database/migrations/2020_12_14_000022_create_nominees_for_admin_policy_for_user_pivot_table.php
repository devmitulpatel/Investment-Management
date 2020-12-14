<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNomineesForAdminPolicyForUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('nominees_for_admin_policy_for_user', function (Blueprint $table) {
            $table->unsignedBigInteger('policy_for_user_id');
            $table->foreign('policy_for_user_id', 'policy_for_user_id_fk_2786270')->references('id')->on('policy_for_users')->onDelete('cascade');
            $table->unsignedBigInteger('nominees_for_admin_id');
            $table->foreign('nominees_for_admin_id', 'nominees_for_admin_id_fk_2786270')->references('id')->on('nominees_for_admins')->onDelete('cascade');
        });
    }
}
