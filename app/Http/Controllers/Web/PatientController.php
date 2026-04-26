<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // return the form to create patient
    public function create()
    {
        return view('patients.create');
    }

    // show all patient related to the doctor id
    public function index()
    {
        $allPatients = Patient::where('doctor_id', auth()->id())->latest()->paginate(10);

        return
         view('patients.patient', compact(
             'allPatients'
         ));

    }

    // store th patient data int database
    public function store(Request $request)
    {
         $request->validate(
            [
                'name' => 'required|string|max:255',
                'age' => 'required|integer|min:1|max:120',
                'gender' => 'required',
                'date_of_birth' => 'required',
                'national_id' => 'required|max:14',
                'medical_history' => 'required',
            ]
        );
        Patient::create(
            [
                'doctor_id' => auth()->id(),
                'name' => $request->name,
                'age' => $request->age,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'phone' => $request->phone,
                'national_id' => $request->national_id,
                'medical_history' => $request->medical_history,
            ]
        );

        return redirect()->route('patients.index')->with('success', 'Patient created successfully');
    }

    public function show($id)
    {
        $patient = Patient::findorfail($id);
        $predictions = $patient->predictions()->latest()->get();

        return view('patients.show', compact('patient', 'predictions'));

    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);

        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request ,$id){
       $patient=Patient::findOrFail($id);
       $patient->name=$request->name;
       $patient->age=$request->age;
       $patient->gender=$request->gender;
       $patient->date_of_birth=$request->date_of_birth;
       $patient->phone=$request->phone;
       $patient->national_id=$request->national_id;
       $patient->medical_history=$request->medical_history;
       $patient->save();
       return redirect()->route('patients.index')->with('success', 'updated successfully');
        }

    // delete patient
    public function destroy($id)
    {
        $patient = Patient::findorfail($id);
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'deleted successfully');
        
    }
   
}
