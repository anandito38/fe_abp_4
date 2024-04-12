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

    public function getShopMenuByUserId(Request $request){
        try{
            $headers = [
                'Accept' => 'application\json',
            ];
            // dd($headers);

            $shop_id = $request->shop_id;

            $api_request = [
                'shop_id' => $shop_id,
            ];

            $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/menu/byShop', $api_request);
            $data = $response->json();
            // dd($data);



            if (isset($data)) {
                if ($data['status'] == 'success') {
                    return view('shop.myShopMenu', ['menus'=>$data['data']], ['shop_id' => $shop_id]);
                }else{
                    return view('shop.myShopMenu', ['shop_id' => $shop_id]);
                }
                // return view('shop.myShop',['shop'=>$data['data']], ['menus'=>$data2['data']]);
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


            if ($data['status'] == 'success') {
                    return view('shop.myShop',['shops'=>$data['data']], ['user_id'=>$user_id]);
            } else {
                return view('errors.404');
            }

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }

    public function addShop(Request $request){
        try{
            
            $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application\json',
                'Authorization' => 'Bearer '.$token
            ];
            // dd($headers);

            $namaToko = $request->namaToko;
            $nomorToko = $request->nomorToko;
            $lokasiToko = $request->lokasiToko;
            $user_id = $request->user_id;

            $api_request = [
                'namaToko' => $namaToko,
                'nomorToko' => $nomorToko,
                'lokasiToko' => $lokasiToko,
                'user_id' => $user_id,
            ];

            $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/shop/add', $api_request);
            $data = $response->json();
            // dd($data);
            if ($data['status'] == 'success') {
                toastr()->success('Shop added succesfully', 'Shop');
                return redirect('/index');
            } else {
                toastr()->error('Failed to add shop', 'Shop');
                return redirect('/index');
            }

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }
}
