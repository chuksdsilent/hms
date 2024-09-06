<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use App\Patients;
class DrugPatientBills extends Model
{
    use Uuids;

    protected $guarded = [];

    public function patients()
    {
        return $this->belongsTo(Patients::class, "patient_id");
    }

    public function drugs()
    {
        return $this->belongsTo(Drugs::class, "drug_id");
    }
}
