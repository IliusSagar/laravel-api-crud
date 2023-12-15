<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        
      $student = Student::all();

      return response()->json($student);
    }

    public function store(Request $request){

        Student::create([
            'name' => $request->name,
            'course' => $request->course,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

    } // End Method

    public function destroy($id) {
        $student = Student::find($id);
    
        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }
    
        $student->delete();
    
        return response()->json(['message' => 'Student deleted successfully']);
    }
    

}
