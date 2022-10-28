<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Submit extends Model
{
    use AsSource;
    use HasFactory;
    use Filterable;

    protected $fillable = ['name', 'phone' ,'email', 'checked', 'description'];

    protected $allowedSorts = [
        'id', 'created_at','name', 'phone' ,'email', 'checked', 'description'
    ];
    protected $allowedFilters = [
        'created_at','name', 'phone' ,'email', 'checked', 'description'
    ];


}
