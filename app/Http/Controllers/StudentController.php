<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function edit($id){

        $student = Student::find($id);
        return response()->json($student);

    } // End Method

    public function update(Request $request, int $id){

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:11',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
        ], 422);
        }else{
            $student = Student::find($id);

            if($student){

                $student->update([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

                return response()->json([
                    'status' => 200,
                    'message' => "Student Updated Successfully"
            ], 200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => "No Such Student Found!"
            ], 404);
            }
        }

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
