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
        Schema::create('tb_nilai_perbandingan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('kriteria_1')->constrained('tb_kriteria')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('kriteria_2')->constrained('tb_kriteria')->onUpdate('cascade')->onDelete('cascade');
            $table->float('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_nilai_perbandingan');
    }
};
