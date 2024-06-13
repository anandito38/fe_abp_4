<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;
use App\Utils\GetUserInfo;

class UserController extends Controller
{
    //
    public function getAllUser()
    {
        try{
            $token = $_COOKIE['token'];

                $headers = [
                    'Accept' => 'application\json',
                    'Authorization' => 'Bearer '.$token
                ];

                $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/user/all');

                $data = $response->json();
                // dd($data);
                if ($data['status'] == 'success') {
                    return view('admin.panel',['users'=>$data['data']]);
                } else {
                    return view('errors.404');
                }
        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }

    public function editUser()
    {
        try{
            $token = $_COOKIE['token'];

                $headers = [
                    'Accept' => 'application\json',
                    'Authorization' => 'Bearer '.$token
                ];

                $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/user/edit');

                $data = $response->json();
                // dd($data);
                if ($data['status'] == 'success') {
                    return view('admin.panel',['users'=>$data['data']]);
                } else {
                    return view('errors.404');
                }
        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }

    public function deleteUser()
    {
        try{
            $token = $_COOKIE['token'];

                $headers = [
                    'Accept' => 'application\json',
                    'Authorization' => 'Bearer '.$token
                ];

                $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/user/delete');

                $data = $response->json();
                // dd($data);
                if ($data['status'] == 'success') {
                    return view('admin.panel',['users'=>$data['data']]);
                    // return view('panel.shops',['shops'=>$data['data']]);
                } else {
                    return view('errors.404');
                }
        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }
}
