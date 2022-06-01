<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\RumahSakit;

class pasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPasien = Pasien::get();
        $dataRs = RumahSakit::get();
        return view('pasien', ['dataPasien' => $dataPasien, 'dataRs' => $dataRs]);
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
        $insertPs = new Pasien();
        $insertPs->ps_name = $request->nama;
        $insertPs->ps_address = $request->alamat;
        $insertPs->ps_phone = $request->telepon;
        $insertPs->rs_id = $request->rs;
        $insertPs->created_at = date('Y-m-d H:i:s');
        $insertPs->updated_at = date('Y-m-d H:i:s');
        $insertPs->save();

        return redirect('pasien');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updatePs = Pasien::where('ps_id', $id)->first();
        $updatePs->ps_name = $request->nama;
        $updatePs->ps_address = $request->alamat;
        $updatePs->ps_phone = $request->telepon;
        $updatePs->rs_id = $request->rs;
        $updatePs->updated_at = date('Y-m-d H:i:s');
        $updatePs->save();

        return redirect('pasien');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $deletePs = Pasien::where('rs_id', $id)->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
