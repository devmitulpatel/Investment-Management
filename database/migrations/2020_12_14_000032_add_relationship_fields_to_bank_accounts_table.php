<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBankAccountsTable extends Migration
{
    public function up()
    {
        Schema::table('bank_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->foreign('bank_id', 'bank_fk_2780784')->references('id')->on('bank_for_admins');
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id', 'branch_fk_2780785')->references('id')->on('branch_of_banks_for_admins');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_2787198')->references('id')->on('users');
        });
    }
}
