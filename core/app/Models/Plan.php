<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function intervel()
    {
        return $this->belongsTo(ReturnIntervel::class, 'times', 'intervel');
    }
    public function getways()
    {
        return $this->hasMany(ReturnIntervel::class, 'times', 'intervel');
    }
}
