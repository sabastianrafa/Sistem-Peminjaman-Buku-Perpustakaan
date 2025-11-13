<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('id_booking');
            $table->foreignId('id_user')
                ->constrained('users', 'id_user')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('id_buku')
                ->constrained('books', 'id_buku')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('id_admin')
                ->nullable()
                ->constrained('admins', 'id_admin')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->integer('jumlah_buku')->default(1);
            $table->date('tanggal');
            $table->string('status_booking', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
