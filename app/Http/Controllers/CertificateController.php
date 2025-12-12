<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CertificateController extends Controller
{
    protected $token;

    public function __construct()
    {
        $this->token = "Xxt3DInio269nCtyfYNY7OLDuC9LdAeUhjIhil5e0x9VdcJKAcKVRxY3Q2tD";   
    }

    public function index() {
        $response = Http::withHeaders(['X-API-TOKEN' => $this->token])->get('http://localhost:8000/api/certificates');

        $data = $response->json();

        $data = [
            'content' => 'certificate.index',
            'data' => $data,
        ];
        return view('layouts.wrapper', $data);
    }

    public function create($id) {
        $id = decrypt($id);
        $data = [
            'content' => 'certificate.create',
            'template_id' => $id
        ];
        return view('layouts.wrapper', $data);
    }
}
