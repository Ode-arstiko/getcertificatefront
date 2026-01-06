<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CertificateController extends Controller
{
    protected $token;

    public function __construct()
    {
        $this->token = Cache::get('cert_api_token');
    }

    public function index() {
        if(!Cache::has('cert_api_token')) {
            return redirect()->back()->with('tokenInvalid', 'You dont have an active token.');
        }
        $response = Http::withToken($this->token)->get('https://getcertificate-v1.vercel.app/api/api/certificates');

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
        
        $response = Http::withToken($this->token)->post('https://getcertificate-v1.vercel.app/api/api/certificates/store', [
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

        $response = Http::withToken($this->token)->delete('https://getcertificate-v1.vercel.app/api/api/certificates/delete/' . $id);
        // dd($response->json('respon'));

        return redirect()->back();
    }

    public function downloadZip($id)
    {
        $response = Http::withOptions([
            'stream' => true
        ])->withToken($this->token)->get(
            'https://getcertificate-v1.vercel.app/api/api/certificates/download-zip/' . $id
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
        $response = Http::withToken($this->token)->get(
            'https://getcertificate-v1.vercel.app/api/api/certificates/' . $id
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
        ])->withToken($this->token)->get(
            'https://getcertificate-v1.vercel.app/api/api/certificates/download/' . $id
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
