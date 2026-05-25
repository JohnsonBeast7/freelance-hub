<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('freelancer_skill', function (Blueprint $table) {
            $table->foreignId('freelancer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('skill_id')->constrained()->cascadeOnDelete();
            $table->enum('proficiency_level', ['beginner', 'intermediate', 'expert'])->default('intermediate');
            $table->primary(['freelancer_id', 'skill_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('freelancer_skill');
    }
};
