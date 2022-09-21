<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailFinance;
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
        $pemasukan = Finance::where('jenis', "Pemasukan")->sum('jumlah');
        $pengeluaran = Finance::where('jenis', "Pengeluaran")->sum('jumlah');
        $saldo =  $pemasukan - $pengeluaran;

        return view('pages.admin.finance.index', compact('data', 'saldo'));
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
            $data = $request->all();
            $data['users_id'] = Auth::user()->id;
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
        $data = Finance::with(['user', 'details'])->findOrFail($id);
        $detail = DetailFinance::with(['user', 'rapat'])->where('finances_id', $data->id)->latest()->get();
        $pemasukan = Finance::where('jenis', "Pemasukan")->sum('jumlah');
        $pengeluaran = Finance::where('jenis', "Pengeluaran")->sum('jumlah');
        $saldo =  $pemasukan - $pengeluaran;

        return view('pages.admin.finance.detail', compact('data', 'detail', 'saldo'));
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
            $finance = Finance::findOrFail($id);

            $data = $request->all();
            $data['users_id'] = Auth::user()->id;

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

    public function simpanDetail(Request $request)
    {
        $request->validate([
            'satuan' => 'required',
            'qty' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
            'finances_id' => 'required',
        ]);
        try {
            // Simpan Detail Finance
            $data = $request->all();
            $data['users_id'] = Auth::user()->id;
            $data['total'] = $request->qty * $request->harga;
            DetailFinance::create($data);

            // Update Jumlah Finance
            $jumlah = DetailFinance::sum('total');
            $lap = Finance::where('id', $request->finances_id)->first();
            $fin = $request->all();
            $fin['jumlah'] = $jumlah;
            $lap->update($fin);

            return redirect()->back()->with('success', 'Paparan berhasil dibuat!!');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Paparan Gagal dibuat!!');
        }
    }

    public function ubahDetail(Request $request, $id)
    {
        $request->validate([
            'satuan' => 'required',
            'qty' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
            'finances_id' => 'required',
        ]);
        try {
            $finance = DetailFinance::findOrFail($id);

            $data = $request->all();
            $data['users_id'] = Auth::user()->id;
            $data['total'] = $request->qty * $request->harga;

            $finance->update($data);

            // Update Jumlah Finance
            $jumlah = DetailFinance::sum('total');
            $lap = Finance::where('id', $request->finances_id)->first();
            $fin = $request->all();
            $fin['jumlah'] = $jumlah;
            $lap->update($fin);

            return redirect()->back()->with('success', 'Paparan berhasil diupdate!!');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Paparan Gagal diupdate!!');
        }
    }

    public function hapusDetail(Request $request, $id)
    {
        try {
            $finance = DetailFinance::findOrFail($id);
            $finance->delete();

            // Update Jumlah Finance
            $jumlah = DetailFinance::sum('total');
            $lap = Finance::where('id', $request->finances_id)->first();
            $fin = $request->all();
            $fin['jumlah'] = $jumlah;
            $lap->update($fin);

            return redirect()->back()->with('success', 'Paparan berhasil dihapus!!');
        } catch (Exception) {
            return redirect()->back()->with('error', 'Paparan Gagal dihapus!!');
        }
    }
}
