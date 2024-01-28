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
        Schema::create('partes', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('alumno');
            $table->string('gravedad');
            $table->unsignedBigInteger('idprofesor');
            $table->foreign('idprofesor')->references('id')->on('profesores')->onDelete('cascade');
            $table->text('observaciones');
            $table->timestamps();
            // $table->unique('id', 'alumno');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partes');
    }
};
