<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id('id_buku');
            $table->string('judul', 150);
            $table->string('penulis', 100)->nullable();
            $table->string('penerbit', 100)->nullable();
            $table->string('kategori', 50)->nullable();
            $table->string('gambar')->nullable();
            $table->integer('stok')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
