<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use Uuids;
    
    protected $guarded = [];

    public function staff()
    {
        return $this->belongsTo(Staff::class, "staff_id");
    }
}
