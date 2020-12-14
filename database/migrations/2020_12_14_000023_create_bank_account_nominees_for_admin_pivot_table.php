<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountNomineesForAdminPivotTable extends Migration
{
    public function up()
    {
        Schema::create('bank_account_nominees_for_admin', function (Blueprint $table) {
            $table->unsignedBigInteger('bank_account_id');
            $table->foreign('bank_account_id', 'bank_account_id_fk_2786290')->references('id')->on('bank_accounts')->onDelete('cascade');
            $table->unsignedBigInteger('nominees_for_admin_id');
            $table->foreign('nominees_for_admin_id', 'nominees_for_admin_id_fk_2786290')->references('id')->on('nominees_for_admins')->onDelete('cascade');
        });
    }
}
