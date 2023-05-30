<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function payment_handler(Request $request)
    {
        $json = $request->getContent();
        $arr = json_decode($json);
        // $signature_key = hash('sha512', $json['order_id'] . $json['status_code'] . $json['gross_amount'] . env('MIDTRANS_SERVER_KEY'));


        return $arr;
    }
}
