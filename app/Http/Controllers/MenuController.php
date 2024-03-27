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
        try{
            $token = $_COOKIE['token'];

                $headers = [
                    'Accept' => 'application\json',
                    'Authorization' => 'Bearer '.$token
                ];

                $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/menu/all');

                $data = $response->json();
                // dd($data);
                if ($data['status'] == 'success') {
                    return view('menu.menusAll',['menus'=>$data['data']]);
                } else {
                    return view('errors.404');
                }
            }catch(Exception $error){
                return "Error: ".$error->getMessage();
            }

    }
    public function getMenuById(Request $request){
        try{
            
            // $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application\json',
                // 'Authorization' => 'Bearer '.$token
            ];
            // dd($headers);

            $shop_id = $request->shop_id;

            $api_request = [
                'shop_id' => $shop_id,
            ];

            $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/menu/byShop', $api_request);
            $data = $response->json();
            // dd($data);
            if ($data['status'] == 'success') {
                return view('menu.menus',['menus'=>$data['data']]);
            } else {
                return view('errors.404');
            }

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }

    public function addMenu(Request $request){
        try{
            
            $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application\json',
                'Authorization' => 'Bearer '.$token
            ];
            // dd($headers);

            $namaMenu = $request->namaMenu;
            $hargaMenu = $request->hargaMenu;
            $stokMenu = 0;
            $deskripsiMenu = $request->deskripsiMenu;

            $api_request = [
                'namaMenu' => $namaMenu,
                'hargaMenu' => $hargaMenu,
                'stokMenu' => $stokMenu,
                'deskripsiMenu' => $deskripsiMenu
            ];

            $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/menu/add', $api_request);
            $data = $response->json();
            // dd($data);
            if ($data['status'] == 'success') {
                toastr()->success('Menu added succesfully', 'Menu');
                return redirect('/index');
            } else {
                return view('errors.404');
            }

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }
    

}
