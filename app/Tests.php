<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    use Uuids;
    
    protected $guarded = [];

    public function patients()
    {
        return $this->hasMany(Patients::class);
    }
    public function medicals()
    {
        return $this->hasMany(Medicals::class);
    }
}
