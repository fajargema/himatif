<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Finance;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Finance::with(['user'])->latest()->get();

        return view('pages.admin.finance.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.finance.add');
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
            'judul' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required',
            'jenis' => 'required',
            'keterangan' => 'required',
        ]);
        try {
            $fin = Finance::latest()->first();
            if (isset($fin)) {
                if ($request->jenis == "Pemasukan") {
                    $saldo = $fin->saldo + $request->jumlah;
                } else if ($request->jenis == "Pengeluaran") {
                    $saldo = $fin->saldo - $request->jumlah;
                }
            } else {
                $saldo = $request->jumlah;
            }


            $data = $request->all();
            $data['users_id'] = Auth::user()->id;
            $data['saldo'] = $saldo;
            Finance::create($data);

            return redirect()->route('dashboard.finance.index')->with('success', 'Laporan berhasil dibuat!!');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('dashboard.finance.index')->with('error', 'Laporan Gagal dibuat!!');
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
        $data = Finance::findOrFail($id);

        return view('pages.admin.finance.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Finance::findOrFail($id);

        return view('pages.admin.finance.edit', compact('data'));
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
            'judul' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required',
            'jenis' => 'required',
            'keterangan' => 'required',
        ]);
        try {
            $max = Finance::max('id');
            $hitung = $max - 1;
            $fin = Finance::where('id', $hitung)->first();
            if (isset($fin)) {
                if ($request->jenis == "Pemasukan") {
                    $saldo = $fin->saldo + $request->jumlah;
                } else if ($request->jenis == "Pengeluaran") {
                    $saldo = $fin->saldo - $request->jumlah;
                }
            } else {
                $saldo = $request->jumlah;
            }
            $finance = Finance::findOrFail($id);

            $data = $request->all();
            $data['users_id'] = Auth::user()->id;
            $data['saldo'] = $saldo;

            $finance->update($data);

            return redirect()->route('dashboard.finance.index')->with('success', 'Laporan berhasil diupdate!!');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('dashboard.finance.index')->with('error', 'Laporan Gagal diupdate!!');
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
            $finance = Finance::findOrFail($id);
            $finance->delete();

            return redirect()->route('dashboard.finance.index')->with('success', 'Laporan berhasil dihapus!!');
        } catch (Exception) {
            return redirect()->route('dashboard.finance.index')->with('error', 'Laporan Gagal dihapus!!');
        }
    }
}
