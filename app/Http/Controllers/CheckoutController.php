<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;
use App\Utils\GetUserInfo;

class CheckoutController extends Controller
{
    public function addCart(Request $request){
        try{
            
            $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ];
            // dd($headers);

            
            $bookingId = $request->bookingId;
            $menuId = $request->menuId;
            $quantity = $request->quantity;
            $stokMenu = $request->stokMenu;
            // dd($stokMenu);
            if ($quantity > $stokMenu) {
                toastr()->error('Quantity is more than stock', 'Shop');
                return redirect('/index');
            }else {

                $api_request = [
                    'bookingId' => $bookingId,
                    'menuId' => $menuId,
                    'quantity' => $quantity,
                ];
    
                $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/booking/detail/menu/add', $api_request);
                $data = $response->json();
    
    
                // dd($data);
                if ($data['status'] == 'success') {
                    toastr()->success('Menu added succesfully', 'Cart');
                    return redirect('/index');
                } else {
                    toastr()->error('Please fill the field correctly', 'Cart');
                    return redirect('/index');
                }
            }
        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }

    public function showCart(Request $request){
        // $bookingId = intval($bookingId);
        // dd($bookingId);
        try{
            
            $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ];
            // 
            
            $user = $user = GetUserInfo::getUserInfo();
            
            $api_request2 = [
                'user_id' => $user['data']['id']
            ];
            $response2 = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/booking/prog/byUser', $api_request2 );
            $data2 = $response2->json();
            // dd($data2);
            
            $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/booking/detail/menu/'.$data2['data'][0]['id']);
            $data = $response->json();
            // dd($data);


            if ($data['status'] == 'success') {
                return view('bookings.cart', ['carts' => $data['data']['Checkout'], 'bookingId' => $data2['data'][0]['id']]);
            } else {
                return redirect('/index');
            }
            

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }


    public function deleteCart(Request $request){
        try{
            
            $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ];
            
            
            $bookingId = $request->bookingId;
            $menuId = $request->menuId;
            
            
            $api_request = [
                'bookingId' => $bookingId,
                'menuId' => $menuId,
            ];
            // dd($bookingId, $menuId, $api_request);

            $response = Http::withHeaders($headers)->delete($_ENV['BACKEND_API_ENDPOINT'].'/booking/detail/menu/delete', $api_request);
            $data = $response->json();


            // dd($data);
            if ($data['status'] == 'success') {
                toastr()->success('Menu deleted succesfully', 'Cart');
                return redirect('/booking/detail/menu');
            } else {
                toastr()->error('Menu deleted unsuccesful', 'Cart');
                return redirect('/booking/detail/menu');
            }
            

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }

    public function editCart(Request $request){
        try{
            
            $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application\json',
                'Authorization' => 'Bearer '.$token
            ];
            // dd($headers);

            $bookingId = $request->bookingId;
            $menuId = $request->menuId;
            $quantity = $request->quantity;
            $stokMenu = $request->stokMenu;

            if ($quantity > $stokMenu) {
                toastr()->error('Quantity is more than stock', 'Shop');
                return redirect('/booking/detail/menu');
            }else{
                $api_request = [
                    'bookingId' => $bookingId,
                    'menuId' => $menuId,
                    'quantity' => $quantity,
                ];
    
                $response = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/booking/detail/menu/edit', $api_request);
                $data = $response->json();
                // dd($data);
                if ($data['status'] == 'success') {
                    toastr()->success('Menu edited succesfully', 'Menu');
                    // return redirect('/index');
                    return redirect('/booking/detail/menu');
    
                } else {
                    toastr()->error('Failed to edit menu', 'Menu');
                    return redirect('/booking/detail/menu');
                }
            }

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }

}
