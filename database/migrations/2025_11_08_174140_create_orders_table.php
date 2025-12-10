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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('order_code')->unique();
            $table->string('channel')->nullable();
            $table->text('items')->nullable(); // json
            $table->bigInteger('total')->default(0);
            $table->string('address')->nullable();
            $table->string('table_code')->nullable();
            $table->string('midtrans_order_id')->nullable();
            $table->string('qrcode_path')->nullable();
            $table->timestamp('payment_expires_at')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
