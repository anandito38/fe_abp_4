<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;
use App\Utils\GetUserInfo;

class ShopController extends Controller
{
    public function getAllShop()
    {
        try{
            $token = $_COOKIE['token'];

                $headers = [
                    'Accept' => 'application\json',
                    'Authorization' => 'Bearer '.$token
                ];

                $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/shop/all');

                $data = $response->json();
                // dd($data);
                if ($data['status'] == 'success') {
                    return view('shop.shops',['shops'=>$data['data']]);
                } else {
                    return view('errors.404');
                }
            }catch(Exception $error){
                return "Error: ".$error->getMessage();
            }

    }
}
