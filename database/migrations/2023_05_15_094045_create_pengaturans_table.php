<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('pernikahan_id')->unsigned()->nullable();
            $table->foreign('pernikahan_id')->references('id')->on('pernikahans')->onDelete('cascade');
            $table->tinyInteger('akad')->default('1')->comment('1 =  ya, 3= tidak');
            $table->tinyInteger('resepsi')->default('1')->comment('1 =  ya, 3= tidak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturans');
    }
};
