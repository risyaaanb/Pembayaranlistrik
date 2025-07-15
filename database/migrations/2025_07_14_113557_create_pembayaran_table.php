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
        Schema::create('pembayaran', function (Blueprint $table) {
        $table->id();
        $table->foreignId('penggunaan_listrik_id')->constrained('penggunaan_listrik')->onDelete('cascade');
        $table->date('tanggal_bayar');
        $table->integer('jumlah_bayar');
        $table->string('metode_pembayaran')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
