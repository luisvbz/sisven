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
        Schema::create('inputs_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias')->unique();
        });

        Schema::create('outputs_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias')->unique();
        });

        Schema::create('warehouse_stock_movements', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['input','ouput']);
            $table->unsignedBigInteger('input_type_id')->nullable();
            $table->unsignedBigInteger('output_type_id')->nullable();
            $table->string('type_action')->nullable();
            $table->unsignedBigInteger('warehouse_id');
            $table->date('date');
            $table->timestamps();


            $table->foreign('input_type_id')
            ->references('id')
            ->on('inputs_types');

            $table->foreign('output_type_id')
            ->references('id')
            ->on('outputs_types');

            $table->foreign('warehouse_id')
            ->references('id')
            ->on('warehouses');


        });

        Schema::create('warehouse_stock_movements_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movement_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('packages');
            $table->integer('quantity_per_packages');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('movement_id')
            ->references('id')
            ->on('warehouse_stock_movements');

            $table->foreign('product_id')
            ->references('id')
            ->on('products');
        });

        Schema::create('warehouse_product', function (Blueprint $table) {
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('description_quantity')->nullable();
        });


        Schema::create('store_stock_movements', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['input','ouput']);
            $table->unsignedBigInteger('input_type_id')->nullable();
            $table->unsignedBigInteger('output_type_id')->nullable();
            $table->string('type_action')->nullable();
            $table->unsignedBigInteger('store_id');
            $table->date('date');
            $table->timestamps();

            $table->foreign('input_type_id')
            ->references('id')
            ->on('inputs_types');

            $table->foreign('output_type_id')
            ->references('id')
            ->on('outputs_types');

            $table->foreign('store_id')
            ->references('id')
            ->on('stores');


        });

        Schema::create('store_stock_movements_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movement_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('packages');
            $table->integer('quantity_per_packages');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('movement_id')
            ->references('id')
            ->on('store_stock_movements');

            $table->foreign('product_id')
            ->references('id')
            ->on('products');
        });

        Schema::create('store_product', function (Blueprint $table) {
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('description_quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inputs_types');
        Schema::dropIfExists('ouputs_types');
        Schema::dropIfExists('warehouse_stock');
        Schema::dropIfExists('warehouse_stock');
        Schema::dropIfExists('warehouse_stock_movements');
        Schema::dropIfExists('store_stock');
        Schema::dropIfExists('store_stock_movements');
    }
};

