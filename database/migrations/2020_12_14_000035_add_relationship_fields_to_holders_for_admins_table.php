<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHoldersForAdminsTable extends Migration
{
    public function up()
    {
        Schema::table('holders_for_admins', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_2787209')->references('id')->on('users');
        });
    }
}
