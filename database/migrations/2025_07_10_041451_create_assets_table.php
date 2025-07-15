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
            $table->string('code')->unique(); // Kode aset (ICG/...)
            $table->string('name'); // Nama aset
            $table->string('division_owner')->nullable(); // Divisi (Data Owner)
            $table->string('category'); // Kategori aset
            $table->string('asset_number'); // Nomor aset
            $table->string('penanggung_jawab')->nullable(); // Pemegang aset
            $table->string('location'); // Lokasi
            $table->enum('status', ['aktif', 'rusak', 'dipindah'])->default('aktif');
            $table->date('input_date')->nullable(); // Tanggal masuk
            $table->date('purchase_date')->nullable(); // Tanggal pembelian
            $table->date('used_date')->nullable(); // Tanggal digunakan
            $table->decimal('purchase_price', 15, 2)->nullable(); // Harga pembelian
            $table->string('purchase_source')->nullable(); // Sumber pembelian
            $table->string('invoice_number')->nullable(); // Nomor invoice
            $table->string('asset_image')->nullable(); // Foto aset
            $table->string('invoice_image')->nullable(); // Foto invoice
            $table->text('description')->nullable(); // Deskripsi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};