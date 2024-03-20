<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;
use App\Utils\GetUserInfo;

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
                    notify()->success('Login successfully!', 'Authentication');
                    return redirect('/panel');
                } else {
                    notify()->error('Login failed!', 'Authentication');
                    return view('log.login');
                }
            }else if($data['status'] == 'success' && $data['data']['message'] == 'This account already logged in'){
                notify()->info('This account already logged in', 'Authentication');
                return view('log.login');
            } else {
                notify()->error('Invalid credentials', 'Authentication');
                return view('log.login');
            }

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }

    public function logout(){
        try{
            $token = $_COOKIE['token'];

            $headers = [
                'Accept' => 'application\json',
                'Authorization' => 'Bearer '.$token
            ];

            $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/logout');

            $data = $response->json();

            if ($data['status'] == 'success') {
                setcookie('token', '', time() - 3600, '/', '', false, true);
                notify()->error('Logout successfully!', 'Authentication');
                return redirect('/index');
            } else {
                return view('panel', ['data' => $data['message']]);
            }

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }

    public function getUserInfo(){
        $user = GetUserInfo::getUserInfo();

        return view('panel', ['data' => $user['data']]);
    }

    public function AuthDashboard(){
        if (!isset($_COOKIE['token'])) {
            return view('index');
        }

        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];

        try {
            $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/token/test');
            $user = $user = GetUserInfo::getUserInfo();

            $data = $response->json();

            if ($data['status'] == 'success') {
                return view('index', ['cekLogin' => $data, 'userAuth' => $user['data']]);
            } else {
                return view('index');
            }
        } catch (Exception $e) {
            return view('index')->with('error', 'Terjadi kesalahan saat mengakses server. Silakan coba lagi nanti.');
        }
    }
    
}
