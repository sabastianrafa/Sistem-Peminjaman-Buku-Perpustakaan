<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama_user',
        'email',
        'password',
        'alamat',
        'no_hp'
    ];

    protected $hidden = [
        'password'
    ];

    public function ktp()
    {
        return $this->hasOne(Ktp::class, 'no_ktp', 'id_user');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_user');
    }
}