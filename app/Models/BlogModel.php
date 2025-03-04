<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
    use HasFactory;

    protected $table = 'blog';

    protected $primaryKey = 'blog_id';

    protected $fillable = [ 'image','tag','title', 'description','Admin_name'];
}
