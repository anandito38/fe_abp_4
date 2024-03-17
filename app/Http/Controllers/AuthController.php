<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

class AuthController extends Controller
{
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

            if ($data['status'] == 'success' && isset($data['data']['data']) && isset($data['data']['data']['role'])) {
                if ($data['data']['data']['role'] == 'Administrator' || $data['data']['data']['role'] == 'Seller') {
                    setcookie('token', $data['data']['data']['token'], time() + 3600, '/', '', false, true);
                    notify()->success('Login success!', 'Authentication');
                    return view('welcome');
                } else {
                    notify()->error('Login failed!', 'Authentication');
                    return view('log.login');
                }
            }else if($data['status'] == 'success' && $data['data']['data']['message'] == 'This account already logged in'){
                notify()->error('This account already logged in', 'Authentication');
                return view('log.login');
            } else {
                notify()->error('Invalid credentials', 'Authentication');
                return view('log.login');
            }

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }

    // public function logout(Request $request){
    //     try{
    //         $headers = [ 
    //             'Accept' => 'application/json', 
    //             'Authorization' => 'Bearer '.$token
    //         ];

    //         $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/logout');
    //         $data = $response->json();

    //     }catch(Exception $error){
    //         return "Error: ".$error->getMessage();
    //     }
    // }
    
}
