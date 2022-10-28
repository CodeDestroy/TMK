<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class SubCategories extends Model
{
    use AsSource;
    use HasFactory;

    protected $fillable = ['alias', 'name', 'text', 'parent_id'];
}
