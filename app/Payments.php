<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use Uuids;

    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patients::class, "patient_id");
    }
}
