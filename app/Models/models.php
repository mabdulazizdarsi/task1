<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class models extends Model
{
    use HasFactory;
    // protected $table='model';
    public function stock()
    {
        return $this->hasMany(stock::class);
    }
}
