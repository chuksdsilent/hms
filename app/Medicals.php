<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicals extends Model
{
    
    

    protected $guarded = [];

    public function patients()

    {
        return $this->belongsTo(Patients::class);
    }
    public function tests()
    {
        return $this->belongsTo(Tests::class);
    }
}
