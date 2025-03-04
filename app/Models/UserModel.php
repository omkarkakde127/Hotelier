<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserModel extends Model
{
    use HasFactory;
    use Notifiable;

    // Explicitly define the table name
    protected $table = 'users';

    // Specify the fillable fields 
    protected $fillable = ['name', 'email','course', 'password'];
}
