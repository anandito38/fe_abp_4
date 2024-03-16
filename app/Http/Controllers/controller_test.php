<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class controller_test extends Controller
{
    //
    public function getAllShops()
    {
        $shops = DB::select('select * from shops');
        return view('shop',['shops'=>$shops]);
    }
    // public function isiShops($id)
    // {
    //     $shop = DB::table('shops')->where('id', $id)->first();
    //     return view('isi', ['shop' => $shop]);
    // }
    public function isiShops($id)
    {
        $shop = DB::table('shops')->where('id', $id)->first();
        $owner = DB::table('users')->where('id', $shop->user_id)->first();

        return view('isi', ['shop' => $shop, 'owner' => $owner]);
    }

}
