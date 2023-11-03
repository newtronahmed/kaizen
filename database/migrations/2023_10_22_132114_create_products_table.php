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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            //price column:
            // 10 - max number of figures
            // 2 - decimal places
            $table->decimal('selling_price', 10, 2);
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('unit')->nullable(); 
            $table->string('manufacturer')->nullable();
            $table->string('product_type')->nullable();
            $table->decimal('cost_price', 10, 2);
            $table->boolean('returnable')->nullable()->default(false);
            $table->unsignedBigInteger('brand_id')->nullable();
            // $table->string('images')
            // $table->integer('stock_quantity');
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
        Schema::dropIfExists('products');
    }
};
