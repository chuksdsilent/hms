<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use Uuids;
    
    protected $table = "staffs";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
