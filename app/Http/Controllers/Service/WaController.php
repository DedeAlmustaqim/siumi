<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WaController extends Controller
{
    public function sendMessage($noHp, $msg)
    {

        $config = DB::table('config')->first();
        $token = $config->token_wa; // Isi token Anda di sini
        $phone = $noHp; // Ganti dengan nomor telepon tujuan
        $message = urlencode($msg);

        $url = "https://kudus.wablas.com/api/send-message?phone=$phone&message=$message&token=$token";

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);

        $result = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false;
        } else {
            return true;
        }
    }
}
