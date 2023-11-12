<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
    
            'nama',
            'npm',
            'ips1',
            'ips2',
            'ips3',
            'ips4',
            'ips5',
            'status',
    ];
}
