<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->date('order_date')->default(now());
            $table->date('expected_delivery_date')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_terms', ['net_30', 'pay_on_delivery']);
            $table->date('due_date');
            $table->enum('status', ['pending', 'approved', 'in_transit', 'delivered']);
            $table->enum('payment_status', ['unpaid', 'paid'])->default('pending');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
};
