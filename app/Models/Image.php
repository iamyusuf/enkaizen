<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'path'
    ];

    public function getPathAttribute($value)
    {
        return asset('public/' . $value);
    }
}
