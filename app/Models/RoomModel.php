<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomModel extends Model
{
    use HasFactory;

    protected $table = 'room';

    protected $primaryKey = 'room_id';

    protected $fillable = [ 'image','tag','title', 'description'];
}