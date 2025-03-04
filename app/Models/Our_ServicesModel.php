<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Our_ServicesModel extends Model
{
    use HasFactory;

    protected $table = 'our_services';
    protected $primaryKey = 'our_services_id';
    protected $fillable = ['title','description','image'];
}