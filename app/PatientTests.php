<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class PatientTests extends Model
{
    
    use Uuids;

    
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patients::class, "patient_id");
    }

    public function patientTestTransaction()
    {
       return $this->belongsTo(PatientTestTransactions::class, "trx_id");
    }
}
