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
        Schema::create('products_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias');
        });

        Schema::create('products_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias');
            $table->enum('category', ['unidad', 'docena', 'full']);
            $table->unsignedBigInteger('package_id');
            $table->timestamps();

            $table->foreign('package_id')
            ->references('id')
            ->on('products_packages');
        });

        Schema::create('products_measures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->comment('0: Inactivo, 1: Activo');
            $table->unsignedBigInteger('type_id');
            $table->string('code');
            $table->string('description');
            $table->integer('minimun_stock');
            $table->unsignedBigInteger('measure_id');
            $table->decimal('price_per_dozen', 9, 6)->default(0);
            $table->decimal('price_per_unit', 9, 6)->default(0);
            $table->decimal('cost', 9,6)->default(0);
            $table->timestamps();

            $table->foreign('type_id')
            ->references('id')
            ->on('products_types');

            $table->foreign('measure_id')
            ->references('id')
            ->on('products_measures');
        });


        Schema::create('products_stock', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('store_id');
            $table->string('package_qunatity');
            $table->integer('quantity');
            $table->integer('quantity_sunat');

            $table->foreign('product_id')
            ->references('id')
            ->on('products');

            $table->foreign('store_id')
            ->references('id')
            ->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_packages');
        Schema::dropIfExists('products_types');
        Schema::dropIfExists('products_measures');
        Schema::dropIfExists('products');
        Schema::dropIfExists('products_stock');
    }
};
