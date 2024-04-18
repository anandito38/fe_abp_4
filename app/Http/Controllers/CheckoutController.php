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
                    toastr()->success('Menu added succesfully', 'Shop');
                    return redirect('/index');
                } else {
                    toastr()->error('Please fill the field correctly', 'Shop');
                    return redirect('/index');
                }
            }
        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }

    public function showCart($bookingId){
        $bookingId = intval($bookingId);
        // dd($bookingId);
        try{
            
            $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ];
            // 
            $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/booking/detail/menu/'.$bookingId);
            $data = $response->json();
            // dd($bookingId);


            if ($data['status'] == 'success') {
                return view('bookings.cart', ['carts' => $data['data']['Checkout'], 'bookingId' => $bookingId]);
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
                return redirect('/index');
            } else {
                toastr()->error('Menu deleted unsuccesful', 'Cart');
                return redirect('/index');
            }
            

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }

}
