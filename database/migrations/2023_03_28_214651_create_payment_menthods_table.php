<?php

use App\Models\Sale;
use App\Models\PaymentType;
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
        Schema::create('payment_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias')->unique();
        });

        Schema::create('payment_menthods', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sale::class)->constrained();
            $table->foreignIdFor(PaymentType::class)->constrained();
            $table->string('titular')->nullable();
            $table->string('operation')->nullable();
            $table->string('bank')->nullable();
            $table->date('operation_date');
            $table->decimal('amount', 9,2);
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
        Schema::dropIfExists('payment_types');
        Schema::dropIfExists('payment_menthods');
    }
};
