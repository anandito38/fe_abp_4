<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;
use App\Utils\GetUserInfo;

class BookingController extends Controller
{
    public function addBooking(Request $request){
        try{
            
            $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application/json',
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
