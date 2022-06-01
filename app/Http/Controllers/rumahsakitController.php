<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RumahSakit;

class rumahsakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataRs = RumahSakit::get();
        return view('rumahsakit', ['dataRs' => $dataRs]);
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
        $insertRs = new RumahSakit();
        $insertRs->rs_name = $request->nama;
        $insertRs->rs_address = $request->alamat;
        $insertRs->rs_mail = $request->email;
        $insertRs->rs_phone = $request->telepon;
        $insertRs->save();

        return redirect('rumah-sakit');
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
        $updateRs = RumahSakit::where('rs_id', $id)->first();
        $updateRs->rs_name = $request->nama;
        $updateRs->rs_address = $request->alamat;
        $updateRs->rs_mail = $request->email;
        $updateRs->rs_phone = $request->telepon;
        $updateRs->save();

        return redirect('rumah-sakit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $deleteRs = RumahSakit::where('rs_id', $id)->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
