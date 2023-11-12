<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predictionresult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'npm',
        'ips1',
        'ips2',
        'ips3',
        'ips4',
        'ips5',
        'ipk',
        'status_kelulusan',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
