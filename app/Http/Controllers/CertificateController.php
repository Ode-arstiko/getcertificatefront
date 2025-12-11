<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index() {
        $data = [
            'content' => 'certificate.index'
        ];
        return view('layouts.wrapper', $data);
    }
}
