<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class JadwalController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas      = [];
        $ruangs     = Ruang::all();
        $today      = Carbon::now()->toDateString();
        // $jadwals    = Jadwal::with(['user','ruang'])->where('start', '>=', $today)->get();
        $jadwals    = Jadwal::with(['user','ruang'])->get();

        foreach ($jadwals as $jadwal){
            $datas[] = [
                'id'         => $jadwal->id,
                'kegiatan'   => $jadwal->title,
                'title'      => $jadwal->ruang->nama_ruang,
                'id_ruang'   => $jadwal->ruang->id,
                'start'      => $jadwal->start,
                'end'        => $jadwal->finish,
                'keterangan' => $jadwal->keterangan,
                'create_by'  => $jadwal->user->name,
            ];
        }

        return view('jadwal.index', compact('datas', 'ruangs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $today = Carbon::now()->toDateString();

        $request->validate([
            'title'         => 'required',
            'ruang'         => 'required',
            'startDate'     => 'required|after_or_equal:'.$today,
            'startTime'     => 'required|date_format:H:i',
            'endTime'       => 'required|date_format:H:i|after:startTime',
            // 'keterangan'    => 'required',
        ]);

        $start  = $request->startDate.' '.$request->startTime.':00';
        $finish = $request->startDate.' '.$request->endTime.':00';

        Jadwal::create([
            'user_id'       => $request->user,
            'ruang_id'      => $request->ruang,
            'title'         => $request->title,
            'start'         => $start,
            'finish'        => $finish,
            'keterangan'    => $request->keterangan,
        ]);

        return redirect(route('jadwal.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {

        $today = Carbon::now()->toDateString();

        $request->validate([
            'title'         => 'required',
            'ruang'         => 'required',
            'startDate'     => 'required|after_or_equal:'.$today,
            'startTime'     => 'required|date_format:H:i',
            'endTime'       => 'required|date_format:H:i|after:startTime',
            // 'keterangan'    => 'required',
        ]);

        $start  = $request->startDate.' '.$request->startTime.':00';
        $finish = $request->startDate.' '.$request->endTime.':00';

        $jadwal->update([
            'ruang_id'      => $request->ruang,
            'title'         => $request->title,
            'start'         => $start,
            'finish'        => $finish,
            'keterangan'    => $request->keterangan,
        ]);

        return redirect(route('jadwal.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        //
    }
}
