<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\PubnubConfig;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function signUp(Request $request) {
        $username = $request->get('username');
        $exists = User::where('username',$username)->first();      
       
        if($exists) {
            return response()->json("failed");
        }
        else {
            $uuid = $request->get('uuid');
            $pubnub = new PubnubConfig($uuid);
            $pubnub->grantGlobal($uuid);
            $password = bcrypt($request->get('password'));
            User::create([
            'uuid' => $uuid,
            'username' => $username,
            'password' => $password
            ]);
            return response()->json("success");   
        }
    }
    
    public function signIn(Request $request) {
        $username = $request->get('username');
        $password = $request->get('password');
        $exists = User::where('username',$username)->first();
        $pubnub = new PubnubConfig($exists->uuid);
        $pubnub->grantGlobal($exists->uuid);
        if($exists) {
            $passwordCorrect = Hash::check($password,$exists->password);
            return response()->json($passwordCorrect);
        }
    }

    public function getUUID(Request $request) {
        $username = $request->get('username');
        $user = User::where('username',$username)->first();
        $uuid = $user->uuid;
        return response()->json($uuid);
    }

    public function addUser(Request $request) {
        $username1 = $request->get('username');
        $username2 = $request->get('remoteUsername');
        $exists = User::where('username',$username2)->first();
        $callingUser = User::where('username',$username1)->first();
        $uuid1 = $callingUser->uuid;
        if($exists) {
            $uuid2 = $exists->uuid;
            $pubnub = new PubnubConfig($uuid1);
            $pubnub->grantOne($uuid1,$uuid2);
            return response()->json($uuid2);
        }
        else {
            return response()->json("404");
        }
    }
}
