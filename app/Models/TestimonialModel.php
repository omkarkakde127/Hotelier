<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialModel extends Model
{
    use HasFactory;

    protected $table = 'testimonial';
    protected $primaryKey = 'testimonial_id';
    protected $fillable = ['image','description','name','profession'];
}