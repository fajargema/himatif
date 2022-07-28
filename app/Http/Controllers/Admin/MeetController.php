<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Meet::with(['user'])->latest()->get();

        return view('pages.admin.meet.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.meet.add');
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
            'nama' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'required',
            'tempat' => 'required',
        ]);
        try {
            $awal = 'sikab';
            $akhir = Meet::max('id');

            $data = $request->all();
            $data['kode'] = sprintf("%03s", abs($akhir + 1)) . '-' . $awal . '-' . $request->jenis . '-' . date('dmY');
            $data['users_id'] = Auth::user()->id;
            Meet::create($data);

            return redirect()->route('dashboard.meet.index')->with('success', 'Rapat berhasil dibuat!!');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('dashboard.meet.index')->with('error', 'Rapat Gagal dibuat!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Meet::findOrFail($id);

        return view('pages.admin.meet.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Meet::findOrFail($id);

        return view('pages.admin.meet.edit', compact('data'));
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
        $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'required',
            'tempat' => 'required',
        ]);
        try {
            $meet = Meet::findOrFail($id);

            $data = $request->all();
            $data['users_id'] = Auth::user()->id;

            $meet->update($data);

            return redirect()->route('dashboard.meet.index')->with('success', 'Rapat berhasil diupdate!!');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('dashboard.meet.index')->with('error', 'Rapat Gagal diupdate!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $meet = Meet::findOrFail($id);
            $meet->delete();

            return redirect()->route('dashboard.meet.index')->with('success', 'Rapat berhasil dihapus!!');
        } catch (Exception) {
            return redirect()->route('dashboard.meet.index')->with('error', 'Rapat Gagal dihapus!!');
        }
    }

    public function scan($id)
    {
        $data = Meet::findOrFail($id);

        return view('pages.admin.meet.scan', compact('data'));
    }
}
