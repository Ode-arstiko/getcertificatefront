<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CtemplateController extends Controller
{
    protected $token;

    public function __construct()
    {
        $this->token = Cache::get('cert_api_token');
    }

    public function index() {
        if(!Cache::has('cert_api_token')) {
            return redirect('/')->with('tokenInvalid', 'You dont have an active token.');
        }
        $response = Http::withToken($this->token)->get('https://getcertificate-v1.vercel.app/api/api/ctemplates');
        $ctemplates = $response->json();

        return view('layouts.wrapper', [
            'content' => 'ctemplate.index',
            'ctemplate' => $ctemplates
        ]);
    }

    public function create() {
        $response = Http::withToken($this->token)->post('https://getcertificate-v1.vercel.app/api/api/get-temp-token', [
            'app_id' => env('CERT_APP_ID'),
            'app_secret' => env('CERT_APP_SECRET')
        ]);

        $dataResponse = $response->json();

        $data = [
            'content' => 'ctemplate.create',
            'url' => 'https://getcertificate-v1.vercel.app/canvas-editor?token=' . $dataResponse['access_token']
        ];
        return view('layouts.wrapper', $data);
    }

    public function edit($id)
    {
        $id = decrypt($id);

        $response = Http::withToken($this->token)->post('https://getcertificate-v1.vercel.app/api/api/get-temp-token', [
            'app_id' => env('CERT_APP_ID'),
            'app_secret' => env('CERT_APP_SECRET')
        ]);

        $dataResponse = $response->json();

        $data = [
            'content' => 'ctemplate.edit',
            'url' => 'https://getcertificate-v1.vercel.app/canvas-editor-edit/' . $id . '?token=' . $dataResponse['access_token']
        ];

        return view('layouts.wrapper', $data);
    }

    public function delete($id) {
        $id = decrypt($id);
        Http::withToken($this->token)->delete('https://getcertificate-v1.vercel.app/api/api/ctemplates/delete/' . $id);
        return redirect()->back();
    }
}
