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
        Schema::create('pernikahans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable()->default(null);
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nama_cowo', 100);
            $table->string('nama_al_cowo', 100);
            $table->string('nama_cewe', 100);
            $table->string('nama_al_cewe', 100);
            $table->string('nama_pak_cowo', 100);
            $table->string('nama_mak_cewe', 100);
            $table->string('nama_mak_cowo', 100);
            $table->string('nama_pak_cewe', 100);
            $table->string('alamat_akad', 255)->nullable();
            $table->string('alamat_resepsi', 255)->nullable();
            $table->string('map', 255)->nullable();
            $table->dateTime('akad')->nullable();
            $table->dateTime('resepsi')->nullable();
            $table->string('sambutan1', 255);
            $table->string('sambutan2', 255);
            $table->string('sambutan3', 255);
            $table->string('sambutan4', 255);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pernikahans');
    }
};
