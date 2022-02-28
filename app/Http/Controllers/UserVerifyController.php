<?php

namespace App\Http\Controllers;

use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\User;

class UserVerifyController extends Controller
{
    public function verifyUserData($token){
        $verifyUser = UserVerify::where('token', $token)->first();
  
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            $user = [
                "isVerified" => false,
                "type" => "",                
            ];
            if($verifyUser->nim_mahasiswa != null || $verifyUser->nim_mahasiswa != ""){
                if($verifyUser->mahasiswa_verified->is_verified){
                    $user["isVerified"] = true;
                    $user["type"] = "peminjam";
                }else{
                    $verifyUser->mahasiswa_verified->is_verified = true;
                    $user["type"] = "peminjam";
                    $verifyUser->mahasiswa_verified->save();
                }
            }else if($verifyUser->nip_staff != null || $verifyUser->nip_staff != ""){
                if($verifyUser->staff_verified->is_verified){
                    $user["isVerified"] = true;
                    $user["type"] = "peminjam";
                }else{
                    $verifyUser->staff_verified->is_verified = true;
                    $user["type"] = "peminjam";
                    $verifyUser->staff_verified->save();
                }
            }else if($verifyUser->user_id != null || $verifyUser->user_id != ""){
                if($verifyUser->user_verified->is_verified){
                    $user["isVerified"] = true;
                    $user["type"] = "admin";
                }else{
                    $verifyUser->user_verified->is_verified = true;
                    $user["type"] = "admin";                    
                    $verifyUser->user_verified->save();
                }
            }
        }

        return view('emails.userVerified', ["user" => $user]);  
    }

    public function ViewUserVerified(){
        $user = [
            "isVerified" => false,
            "type" => "admin",            
        ];
        return view('emails.userVerified', ["user" => $user]);
    }

}
