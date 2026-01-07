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
    Schema::create('check_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('monitor_id')->constrained()->onDelete('cascade');
        $table->integer('status_code');
        $table->integer('response_time'); // in ms
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_logs');
    }
};
