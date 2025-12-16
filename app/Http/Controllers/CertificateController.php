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

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'juara' => 'required',
            'template_id' => 'required'
        ]);
        
        $response = Http::withHeaders(['X-API-TOKEN' => $this->token])->post('http://localhost:8000/api/certificates/store', [
            'nama' => $request->nama,
            'juara' => $request->juara,
            'template_id' => $request->template_id
        ]);

        if ($response->json('success') == true) {
            return redirect('/certificates')->with('certificateOnProcess', 'Your certificates on process, please wait for a while...');
        } else {
            return redirect('/certificates')->with('httpError', 'Response request failed, aborted.');
        }
    }

    public function delete($id) {
        $id = decrypt($id);

        Http::withHeaders(['X-API-TOKEN' => $this->token])->delete('http://localhost:8000/api/certificates/delete/' . $id);

        return redirect()->back();
    }
}
