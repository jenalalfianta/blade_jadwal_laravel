<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas= [];

        $jadwals = Jadwal::with(['user','ruang'])->get();

        foreach ($jadwals as $jadwal){
            $datas[] = [
                'title' => $jadwal->ruang->nama_ruang,
                'start' => $jadwal->start,
                'end' => $jadwal->finish,
                'keterangan' => $jadwal->keterangan,
                'create_by' => $jadwal->user->name,
            ];
        }

        return view('jadwal.index', compact('datas'));

        // all: [
        //     App\Models\Jadwal {#4690
        //       id: 1,
        //       user_id: 1,
        //       ruang_id: 1,
        //       title: "Lokakarya Bahasa dan Sastra",
        //       start: "2023-01-24 09:00:00",
        //       finish: "2023-01-24 16:00:00",
        //       keterangan: "fakultas",
        //       created_at: "2023-01-24 09:32:24",
        //       updated_at: null,
        //       user: App\Models\User {#4696
        //         id: 1,
        //         name: "Jenal",
        //         email: "jenalalfianta@gmail.com",
        //         email_verified_at: "2023-01-24 09:30:50",
        //         #password: "$2y$10$wlS38V3Xbt9h0OAptUo7.OUt9th1p0tV9.NyMT6L0SQiHjgvIt0Zu",
        //         #remember_token: null,
        //         created_at: "2023-01-24 02:30:37",
        //         updated_at: "2023-01-24 02:30:37",
        //       },
        //       ruang: App\Models\Ruang {#4700
        //         id: 1,
        //         kode_ruang: "1",
        //         nama_ruang: "Auditorium",
        //         lantai_ruang: "5",
        //         created_at: "2023-01-24 09:31:34",
        //         updated_at: null,
        //       },
        //     },
        //   ],
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
        $request->validate([
            'title' => 'required | string',
        ]);

        $jadwal = Jadwal::create([
            'user_id' => 2,
            'ruang_id' => 3,
            'title' => $request->title,
            'start' => $request->start_date,
            'finish' => $request->end_date,
            'keterangan' => 'fakultas',
        ]);

        return response()->json($jadwal);

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
        //
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
