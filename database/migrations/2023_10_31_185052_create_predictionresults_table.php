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
        Schema::create('predictionresults', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->string('npm')->unique();
            $table->float('ips1');
            $table->float('ips2');
            $table->float('ips3');
            $table->float('ips4');
            $table->float('ips5');
            $table->float('ipk');
            $table->boolean('status_kelulusan');
            
            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predictionresults');
    }
};
