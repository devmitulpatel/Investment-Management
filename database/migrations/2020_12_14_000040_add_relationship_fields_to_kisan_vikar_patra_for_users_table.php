<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToKisanVikarPatraForUsersTable extends Migration
{
    public function up()
    {
        Schema::table('kisan_vikar_patra_for_users', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_2787188')->references('id')->on('users');
        });
    }
}
