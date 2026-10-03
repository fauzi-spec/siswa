<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
            $table->string('mata_pelajaran', 100);
            $table->unsignedTinyInteger('semester');
            $table->decimal('nilai', 5, 2);
            $table->timestamps();

            $table->unique(['siswa_id', 'mata_pelajaran', 'semester']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
