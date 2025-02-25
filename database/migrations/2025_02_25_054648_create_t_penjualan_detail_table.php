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
        Schema::create('t_penjualan_detail', function (Blueprint $table) {
            $table->id('detail_id'); // bigint(20) unsigned, auto-increment
            $table->unsignedBigInteger('penjualan_id'); // bigint(20) unsigned
            $table->unsignedBigInteger('barang_id'); // bigint(20) unsigned
            $table->integer('harga'); // int(11)
            $table->integer('jumlah'); // int(11)
            $table->timestamps(); // created_at & updated_at

            // Foreign key references
            $table->foreign('penjualan_id')->references('penjualan_id')->on('t_penjualan')->onDelete('cascade');
            $table->foreign('barang_id')->references('barang_id')->on('m_barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_penjualan_detail');
    }
};
