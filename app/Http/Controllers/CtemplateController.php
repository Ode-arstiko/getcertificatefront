<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CtemplateController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8000/api/ctemplates');
        $ctemplates = $response->json();

        return view('layouts.wrapper', [
            'content' => 'ctemplate.index',
            'ctemplate' => $ctemplates
        ]);
    }

    public function create()
    {
        return view('layouts.wrapper', [
            'content' => 'ctemplate.create'
        ]);
    }

    public function edit($id)
    {
        $id = decrypt($id);

        // 🔥 Ambil 1 data template sesuai ID
        $response = Http::get("http://localhost:8000/api/ctemplates/{$id}");
        $ctemplate = $response->json();

        return view('layouts.wrapper', [
            'content' => 'ctemplate.edit',
            'ctemplate' => $ctemplate
        ]);
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
}
