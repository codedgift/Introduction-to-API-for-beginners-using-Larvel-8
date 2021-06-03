<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    //--- Create Student -----------//
    public function create(Request $request) {
        $validated = $request->validate([
            'firstname' => 'required|min:4',
            'lastname' => 'required|min:4',
            'email' => 'required|unique:students',
            'phone' => 'required|unique:students|min:11',
        ]);

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $created_at = Carbon::now();

        Student::insert([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phone' => $phone,
            'email' => $lastname,
            'created_at' => $created_at
        ]);

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'created_at' => $created_at,
            'create' => [
                'method' =>'POST',
                'href' => 'api/v1/create/student',
                'params' => 'firstname, lastname, email, phone'
            ]
        ];

        $response = [
            'message' => 'Student Created Successfully',
            'data' => $data
        ];

        return response()->json($response, 200);
    }

    //----- Fetch Students -----------//
    public function getStudent() {
        // $students = Student::all();
        $students = DB::table('students')->get();

        $data = [
            'data' => $students,
            'create' => [
                'method' =>'GET',
                'href' => 'api/v1/get/student'
            ]
        ];

        $response = [
            'status' => 'success',
            'data' => $data
        ];

        return response()->json($response, 200);
    }

    //--- Update Student -----------//
    public function update(Request $request, $id) {
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $created_at = Carbon::now();

        $update = Student::find($id)->update([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'created_at' => $created_at
        ]);

        $data = [
            'status' => 'success',
            'create' => [
                'method' =>'POST',
                'href' => 'api/v1/edit/student'
            ]
        ];

        $response = [
            'message' => 'Student Details Updated Successfully',
            'data' => $data
        ];

        return response()->json($response, 200);
    }

    public function delete($id) {

        $student = Student::find($id);

        //---- Check if Student ID is valid -----//
        if($student) {

            Student::find($id)->delete();

            $data = [
                'status' => 'success',
                'create' => [
                    'method' =>'GET',
                    'href' => 'api/v1/delete/student'
                ]
            ];

            $response = [
                'message' => 'Student Deleted Successfully',
                'data' => $data
            ];

            return response()->json($response, 200);

        } else {

            $data = [
                'status' => 'error',
                'create' => [
                    'method' =>'GET',
                    'href' => 'api/v1/delete/student'
                ]
            ];

            $response = [
                'message' => 'invalid Student ID',
                'data' => $data
            ];

            return response()->json($response, 401);

        }

    }
}
