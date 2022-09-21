<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFinance extends Model
{
    use HasFactory;

    protected $fillable = [
        'satuan', 'qty', 'harga', 'total', 'keterangan', 'users_id', 'finances_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function rapat()
    {
        return $this->hasOne(Finance::class, 'id', 'finances_id');
    }
}
