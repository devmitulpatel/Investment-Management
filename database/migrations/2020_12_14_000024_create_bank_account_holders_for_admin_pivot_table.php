<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountHoldersForAdminPivotTable extends Migration
{
    public function up()
    {
        Schema::create('bank_account_holders_for_admin', function (Blueprint $table) {
            $table->unsignedBigInteger('bank_account_id');
            $table->foreign('bank_account_id', 'bank_account_id_fk_2780813')->references('id')->on('bank_accounts')->onDelete('cascade');
            $table->unsignedBigInteger('holders_for_admin_id');
            $table->foreign('holders_for_admin_id', 'holders_for_admin_id_fk_2780813')->references('id')->on('holders_for_admins')->onDelete('cascade');
        });
    }
}
