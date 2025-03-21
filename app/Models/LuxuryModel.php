<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuxuryModel extends Model
{
    use HasFactory;

    protected $table = 'luxury';

    protected $primaryKey = 'luxury_id';

    protected $fillable = [ 'image','title', 'description'];
}
