<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    // use Uuids;

    protected $guarded = [];


    public function drugTransactions()
    {
        return $this->belongsTo(DrugTransactions::class);
    }

    public function patientTests()
    {
        return $this->hasMany(PatientTests::class);
    }

    public function patientTransactions()
    {
        return $this->hasMany(PatientTransactions::class);
    }

    public function patientBills()
    {
        return $this->hasMany(PatientBills::class);
    }
    public function payments()
    {
        return $this->hasMany(Payments::class);
    }
}
