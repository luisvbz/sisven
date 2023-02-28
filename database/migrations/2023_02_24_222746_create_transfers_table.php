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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['requested','approved','rejected','canceled'])->default('requested');
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('requested_by');
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamps();

            $table->foreign('requested_by')
            ->references('id')
            ->on('users');

            $table->foreign('warehouse_id')
            ->references('id')
            ->on('warehouses');

            $table->foreign('store_id')
            ->references('id')
            ->on('stores');
        });

        Schema::create('transfer_product', function (Blueprint $table) {
            $table->unsignedBigInteger('transfer_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');

            $table->foreign('transfer_id')
            ->references('id')
            ->on('transfers');

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
        Schema::dropIfExists('transfers_table');
    }
};
