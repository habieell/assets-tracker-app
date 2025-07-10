<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('location');
            $table->enum('status', ['aktif', 'rusak', 'dipindah'])->default('aktif');
            $table->date('input_date')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // Penanggung Jawab
            $table->date('purchase_date')->nullable(); // Tanggal Pembelian
            $table->date('used_date')->nullable(); // Tanggal Digunakan
            $table->decimal('purchase_price', 15, 2)->nullable(); // Harga Pembelian
            $table->string('purchase_source')->nullable(); // Sumber Pembelian
            $table->string('invoice_number')->nullable(); // Nomor Invoice
            $table->text('description')->nullable(); // Deskripsi Aset
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
