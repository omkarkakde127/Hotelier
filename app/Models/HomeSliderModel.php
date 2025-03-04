<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSliderModel extends Model
{
    use HasFactory;

    protected $table = 'home_slider';
    protected $primaryKey = 'home_slider_id';
    protected $fillable = ['title','description','image'];
}