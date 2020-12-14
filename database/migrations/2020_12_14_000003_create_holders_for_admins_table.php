<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldersForAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('holders_for_admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->integer('contact_no')->nullable();
            $table->string('pan');
            $table->string('aadhar_no');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
