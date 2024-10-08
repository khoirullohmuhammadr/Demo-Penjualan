<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    public function userData()
    {
        return $this->belongsTo(User::class, 'cities_id');


    }
    protected $fillable = [
        'city_name',
    ];
}
