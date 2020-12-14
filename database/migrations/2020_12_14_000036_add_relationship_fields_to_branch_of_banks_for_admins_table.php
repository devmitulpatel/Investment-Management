<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBranchOfBanksForAdminsTable extends Migration
{
    public function up()
    {
        Schema::table('branch_of_banks_for_admins', function (Blueprint $table) {
            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id', 'bank_fk_2780766')->references('id')->on('bank_for_admins');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_2787208')->references('id')->on('users');
        });
    }
}
