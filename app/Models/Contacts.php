<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Contacts extends Model
{
    use AsSource;
    use HasFactory;

    protected $fillable = ['adress', 'phone' ,'email'];
}
