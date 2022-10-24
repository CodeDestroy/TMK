<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Service extends Model
{
    use AsSource;
    use HasFactory;

    protected $fillable = ['header', 'description', 'img_path'];
}
