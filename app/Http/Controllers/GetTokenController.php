<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GetTokenController extends Controller
{
    public function getToken() {
        $response = Http::post('https://getcertificate-v1.vercel.app/api/api/get-token', [
            'app_id' => env('CERT_APP_ID'),
            'app_secret' => env('CERT_APP_SECRET')
        ]);

        $data = $response->json();

        $token = $data['access_token'];
        $ttl = $data['expires_in'];

        Cache::put('cert_api_token', $token, $ttl);

        return redirect('/')->with('tokenSuccess', 'Your token : ' . $token . ', Active for ' . $ttl/60 . ' minutes');
    }
}
