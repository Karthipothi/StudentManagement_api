<?php

namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Models\studentdetails;
use illuminate\support\Facades\App;
use Illuminate\Support\Facades\Log;


use App\Http\Controllers\Controller;
use App\Http\Controllers\teacher;
use App\Models\teacherdetails;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class students extends Controller
{
   public function index()
   {
       $students =studentdetails::all();
        if($students->count()>0)
     {
         return response()->json([
        'status'=> 200,
        'students'=>$students
    ],200);
}
else{
    return response()->json([
        'status'=>404,
        'students_message'=>'No records'
    ],404);
}
}

public function store(Request $request) // Store the data
{
    Log::info(json_encode($request->all()));
    try {
        $validator = Validator::make($request->all(), [
            'name' =>'required|string|max:191',
            'dob' =>'required|date',
            'email' =>'required|email|max:191',
            'course' =>'required|string|max:191',
            'phnnbr' =>'required|digits:10'

        ]);
        Log::info($request->name);
        Log::info($request->dob);
        Log::info($request->email);
        Log::info($request->course);
        Log::info($request->phnnbr);
        if($validator->fails()){
            return response()->json([
                'status'=>422,
                'error'=>$validator->errors()
            ],422);
        }
        else{
            $students=studentdetails::create([
             'name'=>$request->name,
             'dob'=>$request->dob,
             'email'=>$request->email,
             'course'=>$request->course,
             'phnnbr'=>$request->phnnbr,

            ]);
            if($students){
                return response()->json([
                    'status'=>200,
                    'message'=>"student created successfully"
                ],200);
            }
            else{
                return response()->json([
                    'status'=>500,
                    'message'=>"something went wrong"
                ],500);
            }
        }
    } catch (\Exception $e) {
        Log::error('Error while creating student: ' . $e->getMessage());
        return response()->json([
            'status' => 500,
            'message' => "An error occurred while processing your request."
        ], 500);
    }
}


public function show($id)  // show the data
{
$students=studentdetails::find($id);
if($students)
{
    return response()->json([
        'status'=>200,
        'student'=>$students
    ],200);
}
else{
    return response()->json([
        'status'=>404,
        'message'=>"No student Found"
    ],404);
}
}


public function edit($id) // edit the data
{
    $students=studentdetails::find($id);
if($students)
{
    return response()->json([
        'status'=>200,
        'student'=>$students
    ],200);
}
else{
    return response()->json([
        'status'=>404,
        'message'=>"No student Found"
    ],404);
}
}

public function update(Request $request,int $id)
{
    $validator = Validator::make($request->all(), [
        'name' =>'required|string|max:191',
        'dob' =>'required|date',
        'email' =>'required|email|max:191',
        'course' =>'required|string|max:191',
        'phnnbr' =>'required|digits:10'

    ]);
    if($validator->fails()){
        return response()->json([
            'status'=>422,
            'error'=>$validator->errors()
        ],422);
    }
    else{
        $students=studentdetails::find($id);

        if($students){
            $students->update([
                'name'=>$request->name,
                'dob'=>$request->dob,
                'email'=>$request->email,
                'course'=>$request->course,
                'phnnbr'=>$request->phnnbr,

               ]);

            return response()->json([
                'status'=>200,
                'message'=>"student updated successfully"
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>"student not found"
            ],404);
        }
    }
}

public function destroy($id)
{
$students=studentdetails::find($id);
if($students)
{
    $students->delete();
    return response()->json([
        'status'=>200,
        'message'=>"student delete successfully"
    ],200);
}else{
    return response()->json([
        'status'=>404,
        'message'=>"student not found"
    ],404);
}

}

public function dashboardCards()
{
    $totalStudent = StudentDetails::count();
    $totalTeacher = teacherdetails::count();
    $totalUser=User::count();


    return response()->json([
        'totalStudent' => $totalStudent,
        'totalTeacher' => $totalTeacher,
        'totalUser'=>$totalUser
    ]);




}

}





