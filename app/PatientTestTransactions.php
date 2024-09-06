<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class PatientTestTransactions extends Model
{
    use Uuids;

    
    public function patient()
    {
        return $this->belongsTo(Patients::class, "patient_id");
    }

    public function patientTests()
    {
        return $this->hasMany(PatientTests::class, "trx_id");
    }
}
