<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchOfBanksForAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('branch_of_banks_for_admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ifsc_code')->nullable();
            $table->string('city')->nullable();
            $table->string('area')->nullable();
            $table->integer('pincode')->nullable();
            $table->string('ref_contact_name')->nullable();
            $table->integer('ref_contact_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
