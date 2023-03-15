<?php

use App\Models\Sale;
use App\Models\User;
use App\Models\Store;
use App\Models\Client;
use App\Models\Product;
use App\Models\SaleType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_types', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('alias');
            $table->unsignedTinyInteger('quantity');
        });

        Schema::create('sales', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('number')->unique();
            $table->enum('status', ['proccesed','pending','canceled']);
            $table->foreignIdFor(Client::class, 'client_id')->constrained();
            $table->foreignIdFor(Store::class, 'store_id')->constrained();
            $table->foreignIdFor(User::class, 'user_id')->constrained();
            $table->unsignedTinyInteger('has_discount')->default(0);
            $table->enum('currency',['S','D']);
            $table->unsignedInteger('discount_percent')->nullable();
            $table->decimal('total_discount')->nullable();
            $table->decimal('sub_total', 9,2);
            $table->decimal('total',9,2);
            $table->timestamps();


        });

        Schema::create('sales_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sale::class)->constrained();
            $table->foreignIdFor(Product::class)->constrained();
            $table->foreignIdFor(SaleType::class, 'type_id')->constrained('sales_types');
            $table->unsignedInteger('quantity_type');
            $table->unsignedInteger('quantity_total');
            $table->decimal('unit_price', 9,2);
            $table->decimal('total', 9,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_types');
        Schema::dropIfExists('sales');
        Schema::dropIfExists('sales_products');
    }
};
