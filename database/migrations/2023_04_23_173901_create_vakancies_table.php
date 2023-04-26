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
        Schema::create('vakancies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('position_id');
            $table->integer('user_id');
            $table->integer('salary')->nullable();
            $table->string('work_procedures');
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vakancies');
    }
};
