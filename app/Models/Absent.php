<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id', 'mahas_id', 'meets_id'
    ];

    public function panitia()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahas_id');
    }

    public function rapat()
    {
        return $this->hasOne(Meet::class, 'id', 'meets_id');
    }
}
