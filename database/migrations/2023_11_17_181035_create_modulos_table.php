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
        Schema::create('modulos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('codigo');
            $table->string('materia');
            $table->integer('h_semanales');
            $table->integer('h_totales');
            $table->enum('turno', ['morning', 'afternoon']);
            $table->string('aula');
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('especialidad_id')->references('id')->on('especialidades');
            $table->foreign('estudio_id')->references('id')->on('estudios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulos');
    }
};
