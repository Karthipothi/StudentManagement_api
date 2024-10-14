<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    public function userindex()   //
    {
        $users =User::all();
         if($users->count()>0)
      {
          return response()->json([
         'status'=> 200,
         'user'=>$users
     ],200);
 }
 else{
     return response()->json([
         'status'=>404,
         'users_message'=>'No records'
     ],404);
 }
 }


 public function userstore(Request $request) // Store the data
{
    Log::info(json_encode($request->all()));
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:191',
        'email' => 'required|email|max:191',
        'is_admin' => 'required|boolean',
        'password' => 'required|string|min:8'

    ]);
    if($validator->fails()){
        return response()->json([
            'status'=>422,
            'error'=>$validator->errors()
        ],422);
    }
    else{
        $users=User::create([
         'name'=>$request->name,

         'email'=>$request->email,
         'is_admin'=>$request->is_admin,
         'password'=>bcrypt($request->password),

        ]);
        if($users){
            return response()->json([
                'status'=>200,
                'message'=>"user created successfully"
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


public function usershow($id)  // show the data
{
$users=User::find($id);
if($users)
{
    return response()->json([
        'status'=>200,
        'user'=>$users
    ],200);
}
else{
    return response()->json([
        'status'=>404,
        'message'=>"No users Found"
    ],404);
}
}


public function useredit($id) // edit the data
{
    $users=User::find($id);
if($users)
{
    return response()->json([
        'status'=>200,
        'users'=>$users
    ],200);
}
else{
    return response()->json([
        'status'=>404,
        'message'=>"No users Found"
    ],404);
}
}


public function userupdate(Request $request,int $id)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:191',
        'email' => 'required|email|max:191',
        'is_admin' => 'required|boolean',
        'password' => 'required|string|min:8'

    ]);
    if($validator->fails()){
        return response()->json([
            'status'=>422,
            'error'=>$validator->errors()
        ],422);
    }
    else{
        $users=User::find($id);

        if($users){
            $users->update([
                'name'=>$request->name,

                'email'=>$request->email,
                'is_admin'=>$request->is_admin,
                'password'=>bcrypt($request->password),


               ]);

            return response()->json([
                'status'=>200,
                'message'=>"user updated successfully"
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>"user not found"
            ],404);
        }
    }
}

public function userdestroy($id)
{
$users=User::find($id);
if($users)
{
    $users->delete();
    return response()->json([
        'status'=>200,
        'message'=>"users delete successfully"
    ],200);
}else{
    return response()->json([
        'status'=>404,
        'message'=>"users not found"
    ],404);
}
}
}
