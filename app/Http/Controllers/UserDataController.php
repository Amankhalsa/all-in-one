<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Http\Request;

class UserDataController extends Controller
{

    public function index()
    {
        $getUserdata = UserData::get();    
        return view('userData.create',compact('getUserdata'));
    }

    public function getUserData(){
        $userData = UserData::get();
        return json_encode(array('data'=>$userData));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        UserData::create($request->all());
        // return response('Data Inserted Successfully.', 200);
        return response()->json(['status'=>'error',
        'message'=>'Succesfully Send']);
    }

    public function delete($Id){
        $deldtta =   UserData::find($Id);
        $deldtta->delete();
        return response()->json(['status'=>'error',
        'message'=>'Deleted Succesfully ']);
    }
}
