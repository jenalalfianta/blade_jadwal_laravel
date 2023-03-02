<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{

    public function index(Request $request)
    {
        $filter = $request->query('filter');
        
        if(!empty($filter)){
            $ruangs = Ruang::sortable()->where('ruangs.nama_ruang', 'like', '%'.$filter.'%')->paginate(5);
        }else{
            $filter = '';
            $ruangs = Ruang::sortable()->paginate(5);
        }

        return view('ruang.index', compact('ruangs', 'filter'));
    }

    public function create()
    {
        return view('ruang.create');
    }

    
    public function store(Request $request)
    {
        $request->validateWithBag('create',
        [
            'kode_ruang'        => 'required',
            'nama_ruang'        => 'required',
            'lantai_ruang'      => 'required',
        ]);
    }

    
    public function show(Ruang $ruang)
    {
        //
    }

    
    public function edit(Ruang $ruang)
    {
        return view('ruang.edit');
    }

    
    public function update(Request $request, Ruang $ruang)
    {
        //
    }

    
    public function destroy(Ruang $ruang)
    {
        Ruang::find($ruang->id)->delete();
        return redirect('/ruang')->with('message','Ruang Berhasil Dihapus :)');
    }
}
