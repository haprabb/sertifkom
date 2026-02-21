<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
    'NIM', 'Nama', 'Email', 'Kelamin', 'Alamat', 'Tanggal_Lahir'
];
}
