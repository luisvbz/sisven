<?php

use App\Models\Bill;
use App\Models\Sale;
use App\Models\Client;
use App\Models\Product;
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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            //$table->foreignIdFor(Sale::class)->constrained();
            $table->foreignIdFor(Client::class)->constrained();
            $table->enum('status', ['proccesed','canceled']);
            $table->enum('type', ['FACT','BOL','NDD','NDC']);
            $table->string('serie');
            $table->string('number');
            $table->enum('currency',['S','D']);
            $table->decimal('igv_percent',4,2);
            $table->decimal('total_grabada',9,6);
            $table->decimal('total_inafecta',9,6);
            $table->decimal('total_exonerada',9,6);
            $table->decimal('total_igv',9,6);
            $table->decimal('total',9,6);
            $table->string('observations');
            $table->date('emition_date');
            $table->timestamps();
        });

        Schema::create('bills_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Bill::class)->onDelete('cascade');
            $table->foreignIdFor(Product::class)->constrained();
            $table->integer('quantity');
            $table->string('measure');
            $table->decimal('unit_price', 9,6);
            $table->decimal('discount', 9,6);
            $table->decimal('total',9,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
        Schema::dropIfExists('bills_items');
    }
};
