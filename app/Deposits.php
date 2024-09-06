<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposits extends Model
{
    protected $guarded = [];



    public function patients()
    {
        return $this->belongsTo(Patients::class);
    }
}
