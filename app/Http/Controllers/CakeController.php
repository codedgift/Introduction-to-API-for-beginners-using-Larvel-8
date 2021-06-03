<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CakeController extends Controller
{
    //----- Create Cake ---------//
    public function create(Request $request) {
        $validated = $request->validate([
            'firstname' => 'required|min:4',
            'lastname' => 'required|min:4',
            'phone' => 'required|min:11|unique:cakes',
            'email' => 'required|unique:cakes',
        ]);

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');

        //---- Using Eloquent Method ----//
        Cake::insert([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'created_at' => Carbon::now()
        ]);

        $data = [
            'status' => 'success',
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'create' => [
                'method' => 'POST',
                'href' => '/create/cake',
                'param' => 'firstname, lastname, email, phone'
                ]
            ];

        $response = [
            'message' => 'Cake Created Successfully',
            'data' => $data
        ];

        return response()->json($response, 200);
    }

    //---- Fetch all records -------------//
    public function show(){
        //---- Using Eloquent Method ----//
        $cakes = Cake::all();

        $data = [
            'data' => $cakes,
            'create' => [
                'method' => 'GET',
                'href' => '/view/cake'
                ]
            ];

        $response = [
            'status' => 'success',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    //------- Edit Cake --------------//
    public function edit(Request $request, $id) {

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');

        //---- Using Eloquent Method ----//
        Cake::find($id)->update([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'created_at' => Carbon::now()
        ]);


        $data = [
            'status' => 'success',
            'create' => [
                'method' => 'POST',
                'href' => '/edit/cake/{id}'
                ]
            ];

        $response = [
            'message' => 'Cake Updated Successfully',
            'data' => $data
        ];

        return response()->json($response, 200);
    }

    //---------- Delete Cake -------------//
    public function delete($id) {
        //---- Using Eloquent Method ----//
        $cake = Cake::find($id);

        //--- Check if the cake ID is valid before deleting --//
        if($cake) {

            Cake::find($id)->delete();

            $data = [
                'status' => 'success',
                'create' => [
                    'method' => 'GET',
                    'href' => '/delete/cake/{id}'
                    ]
                ];

            $response = [
                'message' => 'Cake Deleted Successfully',
                'data' => $data
            ];

            return response()->json($response, 200);

        } else {
            
            $data = [
                'status' => 'error',
                'create' => [
                    'method' => 'GET',
                    'href' => '/delete/cake/{id}'
                    ]
                ];

            $response = [
                'message' => 'Invalid Cake ID',
                'data' => $data
            ];

            return response()->json($response, 401);
        }

    }
}
