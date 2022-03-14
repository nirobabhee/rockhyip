<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;
    protected $table = 'investments';
    protected $guarded = ['id'];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    public function intervel()
    {
        return $this->belongsTo(ReturnIntervel::class);
    }
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
