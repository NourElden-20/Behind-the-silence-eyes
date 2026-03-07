<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PredectionController extends Controller
{
public function create($id){
$patient=Patient::findOrFail($id);
return view('predections.create',compact('patient'));
}
}
