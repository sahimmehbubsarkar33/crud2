<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stud;
use Illuminate\Support\Facades\Validator;
class StudController extends Controller
{
    public function create(Request $req){
        $validate = Validator::make($req->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
        ]);
        if($validate->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'falied to validate',
                'error'=>$validate->errors()
            ],400);

        }
        $users = Stud::create([
            'name'=>$req->name ?? " ",
            'email'=>$req->email ?? " ",
            'phone'=>$req->phone ?? " "
        ]);
        if($users){
            return response()->json([
                'status'=>true,
                'message'=>'data submitted',
                'value'=>$users
            ],200);
        }
        else{
            return response()->json([
                'status'=>true,
                'message'=>'data submitted',
                'value'=>$users
            ],201);
        }

    }
    public function display(){
        $users = Stud::all();
        if($users){
            return response()->json([
                'status'=>true,
                'message'=>'data displayed',
                'value'=>$users
            ],200);
        }
    }
    public function update(Request $req , $id){
        $users = Stud::find($req->id);
        if(!$users){
            return response()->json([
                'status'=>false,
                'message'=>'not found',
                'error'=>$users->errors()
            ],400);
        }
        $validate = Validator::make($req->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',

        ]);
        //Update the values
        $users->name = $req->name ?? " ";
        $users->email = $req->email ?? " ";
        $users->phone = $req->phone ?? " ";
        $users->save();
        return response()->json([
            'status'=>true,
            'message'=>'data updated',
            'value'=>$users
        ],200);

    }
    public function delete($id){
        $users = Stud::findOrFail($id);
        $users->delete();
    }
}
