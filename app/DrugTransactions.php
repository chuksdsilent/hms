<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class DrugTransactions extends Model
{
    use Uuids;
    
    protected $guarded = [];

    public function patients()
    {
        return $this->belongsTo(Patients::class, "patient_id");
    }
}
