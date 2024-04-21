<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;
use App\Utils\GetUserInfo;

class BookingController extends Controller
{
    public function addInvoice(Request $request){
        try{
            
            $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ];
            // dd($headers);

            $booking_id = $request->booking_id;

            $api_request = [
                'metodePembayaran' => "QRIS",
                'booking_id' => $booking_id,

            ];

            $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/invoice/add', $api_request);
            $data = $response->json();
            dd($data, $api_request);
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
