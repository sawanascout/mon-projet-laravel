<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('customer_name');
            $table->string('whatsapp_number')->nullable();
            $table->string('city');
            $table->text('commentaire')->nullable();
            //$table->string('address')->nullable();
            $table->string('status')->default('pending'); // pending, processing, completed, cancelled
            $table->decimal('total', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
