<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CertificateController extends Controller
{
    protected $token;

    public function __construct()
    {
        $this->token = "vE2lRDPxc3iGadiwcbajooMV4zssadLC0hoXU5uaIgg5BipQBK7F6cdRqZIf";
    }

    public function index() {
        $response = Http::withHeaders(['X-API-TOKEN' => $this->token])->get('http://localhost:8000/api/certificate');
        $certificate = $response->json();
        $template = $response->json();
        $zips = $response->json();
        $data = [
            'content' => 'certificate.index',
            'certificate' => $certificate,
            'template' => $template,
            'zips' => $zips
        ];
        return view('layouts.wrapper', $data);
    }
}
