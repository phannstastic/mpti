<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    // Sesuaikan dengan kolom di tabel menu_items Anda
    protected $fillable = [
        'name',
        'image',
        'category',
        'description',
        'price',
    ];
}
