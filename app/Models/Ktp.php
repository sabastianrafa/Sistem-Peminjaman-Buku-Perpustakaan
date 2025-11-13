<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ktp extends Model
{
    use HasFactory;

    protected $table = 'ktp';
    protected $primaryKey = 'no_ktp';

    protected $fillable = [
        'no_ktp',
        'nama_user',
        'alamat',
        'status_validasi'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function user()
    {
        return $this->belongsTo(User::class, 'no_ktp', 'id_user');
    }
}