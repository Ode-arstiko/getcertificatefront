<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CtemplateController extends Controller
{
    protected $token;

    public function __construct()
    {
        $this->token = "Xxt3DInio269nCtyfYNY7OLDuC9LdAeUhjIhil5e0x9VdcJKAcKVRxY3Q2tD";
    }

    public function index() {
        $response = Http::withHeaders(['X-API-TOKEN' => $this->token])->get('http://localhost:8000/api/ctemplates');
        $ctemplates = $response->json();

        return view('layouts.wrapper', [
            'content' => 'ctemplate.index',
            'ctemplate' => $ctemplates
        ]);
    }

    public function create() {
        $data = [
            'content' => 'ctemplate.create'
        ];
        return view('layouts.wrapper', $data);
    }

    public function edit($id)
    {
        $id = decrypt($id);

        return view('layouts.wrapper', ['content' => 'ctemplate.edit', 'id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $id = decrypt($id);

        $request->validate([
            'template_name' => 'required',
            'elements' => 'required'
        ]);

        // 🔥 Kirim update ke API
        $response = Http::put("http://localhost:8000/api/ctemplates/{$id}", [
            'template_name' => $request->template_name,
            'elements'      => json_encode($request->elements)
        ]);

        if ($response->successful()) {
            return redirect('/ctemplates')->with('success', 'Template updated successfully');
        }

        return back()->with('error', 'Failed to update template');
    }

    public function delete($id) {
        $id = decrypt($id);
        Http::withHeaders(['X-API-TOKEN' => $this->token])->delete('http://localhost:8000/api/ctemplates/delete/' . $id);
        return redirect()->back();
    }
}
