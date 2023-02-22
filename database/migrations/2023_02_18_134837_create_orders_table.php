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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('proccesed');
            $table->unsignedBigInteger('supplier_id');
            $table->date('date');
            $table->decimal('cost', 9,2);
            $table->timestamps();

            $table->foreign('supplier_id')
            ->references('id')
            ->on('suppliers');
        });

        Schema::create('orders_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('packages');
            $table->integer('quantity_per_packages');
            $table->integer('total');
            $table->decimal('cost', 9,2);

            $table->foreign('order_id')
            ->references('id')
            ->on('orders');

            $table->foreign('product_id')
            ->references('id')
            ->on('products');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('orders_details');
    }
};
