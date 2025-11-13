<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKtpTable extends Migration
{
    public function up()
    {
        Schema::create('ktp', function (Blueprint $table) {
            $table->string('no_ktp', 25)->primary();
            $table->string('nama_user', 100);
            $table->text('alamat')->nullable();
            $table->string('status_validasi', 50)->nullable();
            $table->foreignId('id_user')
                ->constrained('users', 'id_user')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ktp');
    }
}
