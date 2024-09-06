<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientReferral extends Model
{
    protected $guarded = [];

    protected $table = "patient_referral";


    public function patients()
    {
        return $this->belongsTo(Patients::class);
    }
}
