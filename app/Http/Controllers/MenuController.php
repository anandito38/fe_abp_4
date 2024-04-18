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
                if (isset($_COOKIE['token'])) {
                    $token = $_COOKIE['token'];
                    $headers = [
                        'Accept' => 'application\json',
                        'Authorization' => 'Bearer '.$token
                    ];
                    $response2 = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/token/test');
                    $user = $user = GetUserInfo::getUserInfo();
                    $data2 = $response2->json();
                }else{
                    $headers = [
                        'Accept' => 'application\json',
                    ];
                    $token = null;
                }
                


                $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/menu/all');
                $data = $response->json();
                
                $api_request = [
                    'user_id' => $user['data']['id']
                ];
                $response3 = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/booking/prog/byUser', $api_request );
                $data3 = $response3->json();
                
                // dd($data2);
                // dd($user);
                if ($data['status'] == 'success') {
                    if (isset($_COOKIE['token'])){
                        if (isset($data3['data'][0]['id'])) {
                            $bookingId = $data3['data'][0]['id'];
                        } else {
                            $bookingId = null;
                        }
                        return view('menu.menusAll',['menus'=>$data['data'], 'cekLogin' => $data2, 'userAuth' => $user['data'], 'bookingId' => $bookingId]);
                    }else {
                        return view('menu.menusAll',['menus'=>$data['data']]);
                    }
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
            if (isset($_COOKIE['token'])) {
                $token = $_COOKIE['token'];
                $headers = [
                    'Accept' => 'application\json',
                    'Authorization' => 'Bearer '.$token
                ];
                $response2 = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/token/test');
                $user = $user = GetUserInfo::getUserInfo();
                $data2 = $response2->json();
            }else{
                $headers = [
                    'Accept' => 'application\json',
                ];
                $token = null;
            }
            // dd($headers);

            $shop_id = $request->shop_id;
            $api_request = [
                'shop_id' => $shop_id,
            ];

            $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/menu/byShop', $api_request);
            $data = $response->json();

            $api_request2 = [
                'user_id' => $user['data']['id']
            ];
            $response2 = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/booking/prog/byUser', $api_request2 );
            $data2 = $response2->json();
            
            if ($data['status'] == 'success') {
                if (isset($_COOKIE['token'])){
                    if (isset($data2['data'][0]['id'])) {
                        $bookingId = $data2['data'][0]['id'];
                    } else {
                        $bookingId = null;
                    }
                    return view('menu.menus',['menus'=>$data['data'], 'shop_id' => $shop_id, 'cekLogin' => $data2, 'userAuth' => $user['data'], 'bookingId' => $bookingId]);
                }else {
                    // dd($user);
                    return view('menu.menus',['menus'=>$data['data']], ['shop_id' => $shop_id]);
                }
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
            $shop_id = $request->shop_id;

            $api_request = [
                'namaMenu' => $namaMenu,
                'hargaMenu' => $hargaMenu,
                'stokMenu' => $stokMenu,
                'deskripsiMenu' => $deskripsiMenu,
                'shop_id' => $shop_id
            ];

            $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/menu/add', $api_request);
            $data = $response->json();
            // dd($data);
            if ($data['status'] == 'success') {
                toastr()->success('Menu added succesfully', 'Menu');
                return redirect('/index');
            } else {
                toastr()->error('Failed to add menu', 'Menu');
                return redirect('/index');
            }

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }

    public function editMenu(Request $request){
        try{
            
            $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application\json',
                'Authorization' => 'Bearer '.$token
            ];
            // dd($headers);

            $id = $request->id;
            $namaMenu = $request->namaMenu;
            $hargaMenu = $request->hargaMenu;
            $stokMenu = $request->stokMenu;
            $deskripsiMenu = $request->deskripsiMenu;

            $api_request = [
                'id' => $id,
                'namaMenu' => $namaMenu,
                'hargaMenu' => $hargaMenu,
                'stokMenu' => $stokMenu,
                'deskripsiMenu' => $deskripsiMenu,
            ];

            $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/menu/edit', $api_request);
            $data = $response->json();
            // dd($data);
            if ($data['status'] == 'success') {
                toastr()->success('Menu edited succesfully', 'Menu');
                return redirect('/index');
            } else {
                toastr()->error('Failed to edit menu', 'Menu');
                return redirect('/index');
            }

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }
    

    public function deleteMenu(Request $request){
        try{
            
            $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ];
            
            
            $menuId = $request->menuId;
            
            $api_request = [
                'id' => $menuId,
            ];
            // dd($bookingId, $menuId, $api_request);

            $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/menu/delete', $api_request);
            $data = $response->json();


            // dd($data);
            if ($data['status'] == 'success') {
                toastr()->success('Menu deleted succesfully', 'Menu');
                return redirect('/index');
            } else {
                toastr()->error('Menu deleted unsuccesful', 'Menu');
                return redirect('/index');
            }
            

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }

}
