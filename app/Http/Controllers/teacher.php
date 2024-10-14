<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\teacherdetails;
use illuminate\support\Facades\App;
use Illuminate\Support\Facades\Validator;

class teacher extends Controller
{
    public function teacherindex()   //
    {
        $teachers =teacherdetails::all();
         if($teachers->count()>0)
      {
          return response()->json([
         'status'=> 200,
         'teachers'=>$teachers
     ],200);
 }
 else{
     return response()->json([
         'status'=>404,
         'teachers_message'=>'No records'
     ],404);
 }
 }


 public function teacherstore(Request $request) // Store the data
{
    $validator = Validator::make($request->all(), [
        'name' =>'required|string|max:191',
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
        $teachers=teacherdetails::create([
         'name'=>$request->name,

         'email'=>$request->email,
         'course'=>$request->course,
         'phnnbr'=>$request->phnnbr,

        ]);
        if($teachers){
            return response()->json([
                'status'=>200,
                'message'=>"teacher created successfully"
            ],200);
        }
        else{
            return response()->json([
                'status'=>500,
                'message'=>"something went wrong"
            ],500);
        }
    }
}




public function teachershow($id)  // show the data
{
$teachers=teacherdetails::find($id);
if($teachers)
{
    return response()->json([
        'status'=>200,
        'teacher'=>$teachers
    ],200);
}
else{
    return response()->json([
        'status'=>404,
        'message'=>"No teacher Found"
    ],404);
}
}


public function teacheredit($id) // edit the data
{
    $teachers=teacherdetails::find($id);
if($teachers)
{
    return response()->json([
        'status'=>200,
        'student'=>$teachers
    ],200);
}
else{
    return response()->json([
        'status'=>404,
        'message'=>"No student Found"
    ],404);
}
}

public function teacherupdate(Request $request,int $id)
{
    $validator = Validator::make($request->all(), [
        'name' =>'required|string|max:191',

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
        $teachers=teacherdetails::find($id);

        if($teachers){
            $teachers->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'course'=>$request->course,
                'phnnbr'=>$request->phnnbr,

               ]);

            return response()->json([
                'status'=>200,
                'message'=>"teacher updated successfully"
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>"teacher not found"
            ],404);
        }
    }
}

public function teacherdestroy($id)
{
$teachers=teacherdetails::find($id);
if($teachers)
{
    $teachers->delete();
    return response()->json([
        'status'=>200,
        'message'=>"teacher delete successfully"
    ],200);
}else{
    return response()->json([
        'status'=>404,
        'message'=>"teacher not found"
    ],404);
}
}

}
