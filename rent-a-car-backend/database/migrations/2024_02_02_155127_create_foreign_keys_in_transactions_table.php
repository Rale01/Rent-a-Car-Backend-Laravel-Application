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
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->foreignId('rental_agent_id')->nullable()->references('id')->on('rental_agents')->onDelete('set null');
            $table->foreignId('car_id')->nullable()->references('id')->on('cars')->onDelete('set null');
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('rental_agent_id');
            $table->dropForeign('car_id');
        });
    }
};
