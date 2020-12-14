<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKisanVikarPatraForUsersTable extends Migration
{
    public function up()
    {
        Schema::create('kisan_vikar_patra_for_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_of_purchase');
            $table->date('date_of_maturity')->nullable();
            $table->decimal('amount_paid', 15, 2);
            $table->decimal('amount_received', 15, 2)->nullable();
            $table->longText('purchase_from')->nullable();
            $table->string('ref_contact_name')->nullable();
            $table->integer('ref_contact_no')->nullable();
            $table->string('status')->nullable();
            $table->string('certificate_no');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
