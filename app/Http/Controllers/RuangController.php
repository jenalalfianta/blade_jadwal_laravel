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
            $ruangs = Ruang::sortable()->where('ruangs.nama_ruang', 'like', '%'.$filter.'%')->orderBy('id','DESC')->paginate(5);
        }else{
            $filter = '';
            $ruangs = Ruang::sortable()->orderBy('id','DESC')->paginate(5);
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
            'kode_ruang'        => 'required|unique:ruangs',
            'nama_ruang'        => 'required',
            'lantai_ruang'      => 'required',
        ]);

        Ruang::create([
            'kode_ruang'        => ucfirst($request->kode_ruang),
            'nama_ruang'        => ucfirst($request->nama_ruang),
            'lantai_ruang'      => ucfirst($request->lantai_ruang),

        ]);
        
        return redirect('ruang')->with('message','Ruang Berhasil Ditambahkan :)');

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
