<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutModel extends Model
{
    use HasFactory;

    protected $table = 'about';

    protected $primaryKey = 'about_id';

    protected $fillable = [ 'title', 'description','Rooms','Staffs','Clients'];
}
