<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

class AuthController extends Controller
{
    //
    public function login(Request $request){
        try{
            $headers = [
                'Accept' => 'application/json'
            ];

            $nickname = $request->nickname;
            $password = $request->password;

            $api_request = [
                'nickname' => $nickname,
                'password' => $password
            ];

            $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/login', $api_request);
            $data = $response->json();
            
            if ($data['status'] == 'success'){
                // setcookie('token', $data['data']['token'], time() + 606024, '/', '', false, true);
                // toastr()->info('Login successfully!', 'Authentication', ['timeOut' => 3000]);
                return view('index');
            }else{
                // toastr()->error('Invalid email or password!', 'Authentication', ['timeOut' => 3000]);
                return view('/login');
            }

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }

    // public function logout(){
    //     try{
    //         $headers = [ 'Accept' => 'application/json', 'Authorization' => 'Bearer '.$token];
    //         $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/logout', $api_request);
    //         $data = $response->json();

    //     }catch(Exception $error){
    //         return "Error: ".$error->getMessage();
    //     }
    // }
    
}
