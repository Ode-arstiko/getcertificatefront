<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CtemplateController extends Controller
{
    protected $token;

    public function __construct()
    {
        $this->token = "tcYJOmIox4yCG2zC8pHj78Q5l1Wfs5rxgbMAqnJnGAJ7CfaJYQNbuQHnk0oT";
    }

    public function index() {
        $response = Http::withHeaders(['X-API-TOKEN' => $this->token])->get('http://localhost:8000/api/ctemplates');
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

    public function delete($id) {
        $id = decrypt($id);
        Http::withHeaders(['X-API-TOKEN' => $this->token])->delete('http://localhost:8000/api/ctemplates/delete/' . $id);
        return redirect()->back();
    }
}
