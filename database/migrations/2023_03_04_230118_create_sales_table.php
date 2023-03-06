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
        Schema::create('sales', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('status', ['proccesed','pending','canceled']);
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedTinyInteger('has_discount');
            $table->enum('currency',['S','D']);
            $table->unsignedInteger('discount_percent')->nullable();
            $table->decimal('total_discount')->nullable();
            $table->decimal('sub_total', 9,2);
            $table->decimal('total',9,2);
            $table->timestamps();

            $table->foreign('client_id')
            ->references('id')
            ->on('clients');

            $table->foreign('store_id')
            ->references('id')
            ->on('stores');

            $table->foreign('user_id')
            ->references('id')
            ->on('users');


        });

        Schema::create('sales_products', function (Blueprint $table) {
            $table->id();
            $table->char('sale_id',36);
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('qunatity');
            $table->decimal('unit_price', 9,2);
            $table->decimal('total', 9,2);

            $table->foreign('sale_id')
            ->references('id')
            ->on('sales');

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
        Schema::dropIfExists('sales');
        Schema::dropIfExists('sales_details');
    }
};
