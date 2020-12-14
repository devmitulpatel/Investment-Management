<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFdForUsersTable extends Migration
{
    public function up()
    {
        Schema::table('fd_for_users', function (Blueprint $table) {
            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id', 'bank_fk_2780863')->references('id')->on('bank_for_admins');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id', 'branch_fk_2780864')->references('id')->on('branch_of_banks_for_admins');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_2787191')->references('id')->on('users');
        });
    }
}
