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
        Schema::create('m_category', function (Blueprint $table) {
            $table->id('category_id'); // bigint(20) unsigned, auto-increment
            $table->string('category_code', 10)->unique(); // varchar(10)
            $table->string('category_name', 100); // varchar(100)
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_category');
    }
};
