<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInsuranceForUsersTable extends Migration
{
    public function up()
    {
        Schema::table('insurance_for_users', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_2787190')->references('id')->on('users');
        });
    }
}
