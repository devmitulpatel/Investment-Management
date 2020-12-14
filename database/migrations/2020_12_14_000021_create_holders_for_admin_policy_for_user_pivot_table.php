<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldersForAdminPolicyForUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('holders_for_admin_policy_for_user', function (Blueprint $table) {
            $table->unsignedBigInteger('policy_for_user_id');
            $table->foreign('policy_for_user_id', 'policy_for_user_id_fk_2780848')->references('id')->on('policy_for_users')->onDelete('cascade');
            $table->unsignedBigInteger('holders_for_admin_id');
            $table->foreign('holders_for_admin_id', 'holders_for_admin_id_fk_2780848')->references('id')->on('holders_for_admins')->onDelete('cascade');
        });
    }
}
