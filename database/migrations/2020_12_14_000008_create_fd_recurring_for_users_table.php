<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFdRecurringForUsersTable extends Migration
{
    public function up()
    {
        Schema::create('fd_recurring_for_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('account_no');
            $table->decimal('amount_paid', 15, 2)->nullable();
            $table->float('interest_rate', 15, 5)->nullable();
            $table->date('date_purchase');
            $table->date('date_maturity');
            $table->decimal('amount_received', 15, 2)->nullable();
            $table->decimal('recuring_amount', 15, 2);
            $table->integer('no_recuring')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
