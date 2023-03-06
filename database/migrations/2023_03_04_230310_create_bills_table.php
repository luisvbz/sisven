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
        Schema::create('bills', function (Blueprint $table) {
            $table->uuid('id');
            $table->enum('type', ['FACT','BOL','NDD','NDC']);
            $table->string('serie');
            $table->string('number');
            $table->enum('currency',['S','D']);
            $table->decimal('igv_percent',4,2);
            $table->decimal('total_grabada',9,2);
            $table->decimal('total_inafecta',9,2);
            $table->decimal('total_exonerada',9,2);
            $table->decimal('total_igv',9,2);
            $table->decimal('total',9,2);
            $table->string('observations');
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
        Schema::dropIfExists('bills');
    }
};
