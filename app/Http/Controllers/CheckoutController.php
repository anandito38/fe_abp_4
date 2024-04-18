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
                toastr()->error('Menu already exsist please edit in cart', 'Shop');
                return redirect('/index');
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
            // dd($data['data']['Checkout']);


            if ($data['status'] == 'success') {
                return view('bookings.cart', ['carts' => $data['data']['Checkout']]);
            } else {
                return redirect('/index');
            }
            

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }
}
