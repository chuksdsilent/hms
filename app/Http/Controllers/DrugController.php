<?php

namespace App\Http\Controllers;

use App\Drugs;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    public function getDrugs($id)
    {
        return Drugs::where("id", $id)->value("price");
    }
}
