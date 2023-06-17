<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCustomersTable extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('id')->nullable();
            $table->string('name')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('date')->nullable();
            $table->string('area')->nullable();
            $table->string('price')->nullable();
            $table->string('payment_type')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['id', 'name', 'phone_number', 'date', 'area', 'price', 'payment_type', 'created_at', 'updated_at']);
        });
    }
}
