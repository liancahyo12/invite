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
        Schema::create('komentars', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->timestamps();
            $table->bigInteger('pernikahan_id')->unsigned()->nullable();
            $table->foreign('pernikahan_id')->references('id')->on('pernikahans')->onDelete('cascade');
            $table->string('nama', 100);
            $table->string('komentar', 255);
            $table->tinyInteger('kehadiran')->comment('1 =  hadir, 2 = mungkin, 3= berhalangan');
            $table->string('ip')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('parent_id')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentars');
    }
};
