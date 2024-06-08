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

            $booking_id = $request->bookingId;
            $user = $user = GetUserInfo::getUserInfo();
            $nomorMeja = $request->nomorMeja;
            $waktuAmbil = $request->waktuAmbil;
            // dd($nomorMeja,$waktuAmbil);

            if($nomorMeja == null || $nomorMeja == 0){
                $statusAmbil = "Take Away";
                $nomorMeja  = 0;
            }else{
                $statusAmbil = "Dine in";
            }

            $api_requestBook = [
                'id' => $booking_id,
                'jamAmbil' => $waktuAmbil,
                'statusAmbil' => $statusAmbil,
                'nomorMeja' => $nomorMeja,
            ];

            $responseBook = Http::withHeaders($headers)->put($_ENV['BACKEND_API_ENDPOINT'].'/booking/edit', $api_requestBook);
            $dataBook = $responseBook->json();
            // dd($dataBook);
            $api_request = [
                'metodePembayaran' => "QRIS",
                'booking_id' => $booking_id,
                'user_id' => $user['data']['id']

            ];

            $response = Http::withHeaders($headers)->post($_ENV['BACKEND_API_ENDPOINT'].'/invoice/add', $api_request);
            $data = $response->json();
            // dd($data, $api_request);
            if ($data['status'] == 'success') {
                toastr()->success('Payment succesfully', 'Cart');
                return redirect('/index');
            } else {
                toastr()->error('Payment unsuccesful', 'Cart');
                return redirect('/index');
            }
            

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }
    
    public function showBooking(Request $request){
        try{
            
            $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ];
            // 
            
            $user = $user = GetUserInfo::getUserInfo();
            // dd($user);
            
            $api_request = [
                'user_id' => $user['data']['id']
            ];
            $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/invoice/all/byUser', $api_request );
            $data = $response->json();
            // dd($data['data'],$user);
            
            if ($data['status'] == 'success') {
                return view('bookings.pesananUser', ['invoices' => $data['data']]);
            } else {
                return redirect('/index');
            }
            

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }

    public function showBookingMenu(Request $request){
        try{
            
            $token = $_COOKIE['token'];
            $headers = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ];
            
            $invoice_id = $request->invoice_id;
            
            $api_request = [
                'id' => $invoice_id
            ];
            $response = Http::withHeaders($headers)->get($_ENV['BACKEND_API_ENDPOINT'].'/menu/all/paid/byInvoice', $api_request );
            $data = $response->json();
            // dd($data['data']);
            
            if ($data['status'] == 'success') {
                return view('bookings.pesananMenu', ['menus' => $data['data']]);
            } else {
                return redirect('/index');
            }
            

        }catch(Exception $error){
            return "Error: ".$error->getMessage();
        }
    }
}
