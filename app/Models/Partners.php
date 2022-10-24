<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Partners extends Model
{
    use AsSource;
    use HasFactory;

    protected $fillable = ['header', 'description', 'img_path', 'img_logo_path', 'show_on_main'];
}
