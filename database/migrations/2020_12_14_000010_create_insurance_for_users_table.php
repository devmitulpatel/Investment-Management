<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceForUsersTable extends Migration
{
    public function up()
    {
        Schema::create('insurance_for_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('issuer_name');
            $table->string('name');
            $table->string('policy_no');
            $table->decimal('insured_amount', 15, 2)->nullable();
            $table->string('insurance_type')->nullable();
            $table->decimal('premium_amount', 15, 2)->nullable();
            $table->string('premium_interval')->nullable();
            $table->integer('no_of_premium')->nullable();
            $table->date('date_of_purchase')->nullable();
            $table->date('date_of_maturity')->nullable();
            $table->decimal('amount_paid', 15, 2)->nullable();
            $table->decimal('amount_received', 15, 2)->nullable();
            $table->integer('insured_period')->nullable();
            $table->float('rate_intrest', 15, 2)->nullable();
            $table->string('ref_contact_no')->nullable();
            $table->string('ref_contact_name')->nullable();
            $table->longText('note')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
