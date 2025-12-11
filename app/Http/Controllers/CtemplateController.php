<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CtemplateController extends Controller
{
    public function index() {
        $response = Http::get('http://localhost:8000/api/ctemplates');
        $ctemplates = $response->json();
        $data = [
            'content' => 'ctemplate.index',
            'ctemplate' => $ctemplates
        ];
        return view('layouts.wrapper', $data);
    }
    public function create() {
        $data = [
            'content' => 'ctemplate.create'
        ];
        return view('layouts.wrapper', $data);
    }
}
