<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Main extends Model
{
    use AsSource;
    use HasFactory;

    protected $fillable = ['mainPageDescription'];
}
