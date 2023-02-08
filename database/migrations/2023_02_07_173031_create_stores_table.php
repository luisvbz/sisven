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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->unsignedTinyInteger('is_principal')->default(0);
            $table->string('name');
            $table->char('departament_id', 2);
            $table->char('province_id', 4);
            $table->char('district_id', 6);
            $table->string('address');
            $table->integer('phone_number');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('departament_id')
            ->references('id')
            ->on('departaments');

            $table->foreign('province_id')
            ->references('id')
            ->on('provinces');

            $table->foreign('district_id')
            ->references('id')
            ->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
