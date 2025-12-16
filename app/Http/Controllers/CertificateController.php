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

    public function index()
    {
        $response = Http::withHeaders(['X-API-TOKEN' => $this->token])->get('http://localhost:8000/api/certificates');

        $data = $response->json();

        $data = [
            'content' => 'certificate.index',
            'data' => $data,
        ];
        return view('layouts.wrapper', $data);
    }

    public function create($id)
    {
        $id = decrypt($id);
        $data = [
            'content' => 'certificate.create',
            'template_id' => $id
        ];
        return view('layouts.wrapper', $data);
    }

    public function store(Request $request)
    {
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

    public function delete($id)
    {
        $id = decrypt($id);

        Http::withHeaders(['X-API-TOKEN' => $this->token])->delete('http://localhost:8000/api/certificates/delete/' . $id);

        return redirect()->back();
    }

    public function downloadZip($id)
    {
        $response = Http::withOptions([
            'stream' => true
        ])->get(
            'http://127.0.0.1:8000/api/certificates/download-zip/' . $id
        );

        if ($response->failed()) {
            dd($response->status(), $response->body());
        }

        // 🔥 ambil filename dari header API
        $disposition = $response->header('Content-Disposition');
        $filename = 'certificates.zip';

        if ($disposition && preg_match('/filename="?([^"]+)"?/', $disposition, $matches)) {
            $filename = $matches[1];
        }

        return response()->streamDownload(function () use ($response) {
            echo $response->body();
        }, $filename);
    }


    public function zipDetails($id)
    {
        // ambil data dari API
        $response = Http::get(
            'http://localhost:8000/api/certificates/' . $id
        );

        if ($response->failed()) {
            abort(404);
        }

        $data = [
            'content' => 'certificate.zip_details',
            'zip' => $response->json()['zip'],
            'certificates' => $response->json()['certificates']
        ];

        return view('layouts.wrapper', $data);
    }

    // download pdf per certificate
    public function downloadCertificate($id)
    {
        $response = Http::withOptions([
            'stream' => true
        ])->get(
            'http://localhost:8000/api/certificates/download/' . $id
        );

        if ($response->failed()) {
            abort(404);
        }

        // ambil filename dari header API
        $disposition = $response->header('Content-Disposition');
        $filename = 'certificate.pdf';

        if ($disposition && preg_match('/filename="?([^"]+)"?/', $disposition, $matches)) {
            $filename = $matches[1];
        }

        return response()->streamDownload(function () use ($response) {
            echo $response->body();
        }, $filename);
    }
}
