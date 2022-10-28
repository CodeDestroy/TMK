<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class ProductionType extends Model
{
    use AsSource;
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'alias';
    protected $guarded = [];
    protected $fillable = ['alias ', 'type'];
}
