<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;
use App\Utils\GetUserInfo;
class MenuController extends Controller
{
    public function getAllMenu()
    {
        $token = $_COOKIE['token'];

            $headers = [
                'Accept' => 'application\json',
                'Authorization' => 'Bearer '.$token
            ];
            dd($headers);

            $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/menu/all');

            $data = $response->json();
            dd($data);
            if ($data['status'] == 'success') {
                return view('menus',['menus'=>$data['data']]);
            } else {
                return view('errors.404');
            }

    }
}
