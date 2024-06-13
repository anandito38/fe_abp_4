<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;
use App\Utils\GetUserInfo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{


    public function register(Request $request){
        try{
            $headers = [
                'Accept' => 'application/json'
            ];
            
            $fullName = $request->fullName;
            $nickname = $request->nickname;
            $phoneNumber = $request->phoneNumber;
            $address = $request->address;
            $role = $request->role;
            $password = $request->password;

            $api_request = [
                'fullName' => $fullName,
                'nickname' => $nickname,
                'phoneNumber' => $phoneNumber,
                'address' => $address,
                'role' => $role,
                'password' => $password
            ];

            $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/register', $api_request);
            $data = $response->json();
            // dd($data);
            if ($data['status'] == 'success') {
                toastr()->success('This account register succesfully please login', 'Authentication');
                return redirect('/login');
            } else {
                toastr()->error('Register failed!', 'Authentication');
                return View::make('log.register');
            }

            

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }

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
            // dd($data);

            if ($data['status'] == 'success' && isset($data['data']['data']) && isset($data['data']['data']['role'])) {
                if ($data['data']['data']['role'] == 'Administrator' || $data['data']['data']['role'] == 'Seller' || $data['data']['data']['role'] == 'Buyer') {
                    setcookie('token', $data['data']['data']['token'], time() + 3600, '/', '', false, true);

                    $token = $data['data']['data']['token'];
                    $headers_auth = [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token
                    ];

                    $responseUserInfo = Http::withHeaders($headers_auth)->post($_ENV['BACKEND_API_ENDPOINT'].'/user/info');
                    $getUserInfo = $responseUserInfo->json();
                    
                    Session::put('userInfo', $getUserInfo);
                    toastr()->success('Login successfully!', 'Authentication');
                    return redirect('/index');
                } else {
                    toastr()->error('Login failed!', 'Authentication');
                    return view('log.login');
                }
            }else if($data['status'] == 'success' && $data['data']['message'] == 'This account already logged in'){
                toastr()->info('This account already logged in', 'Authentication');
                return view('log.login');
            } else {
                toastr()->error('Invalid credentials', 'Authentication');
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
                Session::forget('userInfo');
                Session::flush();
                toastr()->info('Logout successfully!', 'Authentication');
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
        // dd($_COOKIE);
        if (!isset($_COOKIE['token'])) {
            $headers2 = [
                'Accept' => 'application/json',
            ];
            try {
    
    
                $response2 = Http::withHeaders($headers2)->get($_ENV['BACKEND_API_ENDPOINT'].'/menu/all');
                $data2 = $response2->json();
    
                if ($data2['status'] == 'success') {
                    return view('index', ['menus'=>$data2['data'], 'bookingId'=> null]);
                } else {
                    return view('index');
                }
            } catch (Exception $e) {
                return view('index')->with('error', 'Terjadi kesalahan saat mengakses server. Silakan coba lagi nanti.');
            }
        }

        $token = $_COOKIE['token'];

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ];
        $headers2 = [
            'Accept' => 'application/json',
        ];

        try {
            $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/token/test');
            $user = $user = GetUserInfo::getUserInfo();


            $response2 = Http::withHeaders($headers2)->get($_ENV['BACKEND_API_ENDPOINT'].'/menu/all');

            $data = $response->json();
            $data2 = $response2->json();
            // dd($data2['data']);
            $api_request = [
                'user_id' => $user['data']['id']
            ];
            $response3 = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/booking/prog/byUser', $api_request );
            $data3 = $response3->json();
            // dd($data3['data'][0]['id']);



            if ($data['status'] == 'success') {
                if (isset($data3['data'][0]['id'])) {
                    $bookingId = $data3['data'][0]['id'];
                } else {
                    $bookingId = null;
                }

                
                return view('index', ['cekLogin' => $data, 'userAuth' => $user['data'], 'menus' => $data2['data'], 'bookingId' => $bookingId, 'userId' => $user['data']['id']]);
            } else {
                return view('index');
            }
        } catch (Exception $e) {
            return view('index')->with('error', 'Terjadi kesalahan saat mengakses server. Silakan coba lagi nanti.');
        }
    }
}
