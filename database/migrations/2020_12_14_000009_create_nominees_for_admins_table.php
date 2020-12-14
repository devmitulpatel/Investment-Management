<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNomineesForAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('nominees_for_admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->integer('contact_no')->nullable();
            $table->string('pan')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
