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
            // $token = $_COOKIE['token'];

                $headers = [
                    'Accept' => 'application\json',
                    // 'Authorization' => 'Bearer '.$token
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

    public function getShopByUserId(Request $request){
        try{
            
            $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application\json',
                'Authorization' => 'Bearer '.$token
            ];
            // dd($headers);

            $user_id = $request->user_id;

            $api_request = [
                'user_id' => $user_id,
            ];

            $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/shop/byUser', $api_request);
            $data = $response->json();
            // dd($data);

            $shop_id = $data['data'][0]['id'];
            $headers2 = [
                'Accept' => 'application\json',
            ];
            $api_request2 = [
                'shop_id' => $shop_id,
            ];
            $response = Http::withHeaders($headers2)->get($_ENV['BACKEND_API_ENDPOINT'].'/menu/byShop', $api_request2);
            $data2 = $response->json();
            dd($data2);

            if ($data['status'] == 'success') {
                if ($data2['message'] == 'Menu not found'){
                    return view('shop.myShop',['shop'=>$data['data']]);
                }else{
                    return view('shop.myShop',['shop'=>$data['data']], ['menus'=>$data2['data']]);
                }
                // return view('shop.myShop',['shop'=>$data['data']], ['menus'=>$data2['data']]);
            } else {
                return view('errors.404');
            }

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }
}
