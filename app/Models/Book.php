<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $primaryKey = 'id_buku';

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'kategori',
        'gambar',
        'stok'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_buku');
    }
}