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
        Schema::create('rental_agents', function (Blueprint $table) {
            $table->id();
            $table->string('name',30);
            $table->string('city',25);
            $table->string('address',40);
            $table->string('email',40);
            $table->string('telephone',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_agents');
    }
};
