<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class PatientBills extends Model
{
    use Uuids;

    public function patients()
    {
        return $this->belongsTo(Patients::class, "patient_id");
    }
}
