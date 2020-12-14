<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNscForUsersTable extends Migration
{
    public function up()
    {
        Schema::create('nsc_for_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount_paid', 15, 2)->nullable();
            $table->decimal('amount_received', 15, 2)->nullable();
            $table->date('date_purchase');
            $table->date('date_maturity')->nullable();
            $table->longText('purchase_from')->nullable();
            $table->string('ref_contact_name')->nullable();
            $table->string('status')->nullable();
            $table->integer('ref_contact_no')->nullable();
            $table->string('certificate_no');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
