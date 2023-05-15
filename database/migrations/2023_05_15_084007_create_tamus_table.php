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
        Schema::create('tamus', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable()->default(null);
            $table->bigInteger('pernikahan_id')->unsigned()->nullable();
            $table->foreign('pernikahan_id')->references('id')->on('pernikahans')->onDelete('cascade');
            $table->timestamps();
            $table->string('nama', 100)->nullable();
            $table->string('alamat', 100)->nullable();
            $table->string('catatan', 100)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tamus');
    }
};
