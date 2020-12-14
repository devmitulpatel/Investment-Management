<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFdRecurringForUserHoldersForAdminPivotTable extends Migration
{
    public function up()
    {
        Schema::create('fd_recurring_for_user_holders_for_admin', function (Blueprint $table) {
            $table->unsignedBigInteger('fd_recurring_for_user_id');
            $table->foreign('fd_recurring_for_user_id', 'fd_recurring_for_user_id_fk_2786544')->references('id')->on('fd_recurring_for_users')->onDelete('cascade');
            $table->unsignedBigInteger('holders_for_admin_id');
            $table->foreign('holders_for_admin_id', 'holders_for_admin_id_fk_2786544')->references('id')->on('holders_for_admins')->onDelete('cascade');
        });
    }
}
