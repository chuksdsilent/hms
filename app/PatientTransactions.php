<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class PatientTransactions extends Model
{
    use Uuids;

    protected $table = "patient_transactions";

    public function patient()
    {
        return $this->belongsTo(Patients::class, "patient_id");
    }
}
