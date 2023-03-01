<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{

    public function index(Request $request)
    {
        $ruangs = Ruang::paginate(10);
        return view('ruang.index')->with('ruangs', $ruangs);
    }

    public function ruangPaging()
    {

    }

    public function create()
    {

    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(Ruang $ruang)
    {
        //
    }

    
    public function edit(Ruang $ruang)
    {
        //
    }

    
    public function update(Request $request, Ruang $ruang)
    {
        //
    }

    
    public function destroy(Ruang $ruang)
    {
        //
    }
}
