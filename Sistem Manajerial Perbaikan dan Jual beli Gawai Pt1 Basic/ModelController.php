<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Models\Customer;
use App\Models\Barang;
use App\Models\BarangVarian;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Service;          
use App\Models\MasterService;

class ModelController extends Controller
{
//Home
    public function index()
    {
        return view('home');
    }

//    public function home()
 //   {
//        return view('home');
 //   }

    public function welcome()
    {
        return view('welcome');
    }

 //Cus

public function customer(Request $req, $locale = 'id')
{
    app()->setLocale($locale);
    $keyword = $req->search;
    if ($keyword) {
        $data_customer = Customer::where('nama', 'like', "%{$keyword}%")
            ->orWhere('kode_customer', 'like', "%{$keyword}%")
            ->orWhere('kontak', 'like', "%{$keyword}%")
            ->get();
    } 
    else {
        $data_customer = Customer::all();
    }
    return view('customer', compact('data_customer', 'locale'));
}
public function createcustomer($locale = 'id')
{
    app()->setLocale($locale);
    return view('createcustomer', compact('locale'));
}

public function savecustomer(Request $req)
{
    app()->setLocale($req->locale);

    $this->validate($req, [
        'nama'   => 'required|string',
        'kontak' => 'required',
        'alamat' => 'required|string'
    ]);

    Customer::create([
        'kode_customer' => $this->generateKodeCustomer(),
        'nama'          => $req->nama,
        'kontak'        => $req->kontak,
        'alamat'        => $req->alamat,
    ]);

    return redirect('/customer')
        ->with('pesan', 'Data customer berhasil disimpan');
}

public function editcustomer($id, $locale = 'id')
{
    app()->setLocale($locale);

    $customer = Customer::findOrFail($id);
    return view('editcustomer', compact('customer', 'locale'));
}

public function updatecustomer(Request $req, $id)
{
    $this->validate($req, [
        'nama'   => 'required|string',
        'kontak' => 'required',
        'alamat' => 'required|string'
    ]);

    $customer = Customer::findOrFail($id);
    $customer->update([
        'nama'   => $req->nama,
        'kontak' => $req->kontak,
        'alamat' => $req->alamat
    ]);

    return redirect('/customer')
        ->with('pesan', 'Data customer berhasil diubah');
}

public function deletecustomer($id)
{
    Customer::findOrFail($id)->delete();

    return redirect('/customer')
        ->with('pesan', 'Data customer berhasil dihapus');
}

//kode
    private function generateKodeCustomer()
    {
        $last = Customer::orderBy('id_customer', 'desc')->first();

        if (!$last || !$last->kode_customer) {
            return 'A001';
        }

        $huruf = substr($last->kode_customer, 0, 1);
        $angka = (int) substr($last->kode_customer, 1);

        if ($angka < 999) {
            $angka++;
        } else {
            $huruf = chr(ord($huruf) + 1);
            $angka = 1;
        }

        return $huruf . str_pad($angka, 3, '0', STR_PAD_LEFT);
    }

//Barang
    public function barang(Request $req, $locale = 'id')
    {
        App::setLocale($locale);
        $search = $req->query('search');
        $data_barang = Barang::with('varian')
            ->when($search, function ($query, $search) {
                $query->where('nama_barang', 'like', "%$search%")
                      ->orWhere('merek', 'like', "%$search%");
            })
            ->get();

        return view('barang', compact('data_barang', 'locale', 'search'));
    }


   public function createbarang($locale = 'id')
{
    App::setLocale($locale);
    return view('createbarang', compact('locale'));
}

//nyimpen
    public function savebarang(Request $req)
    {
        App::setLocale($req->locale);

        $this->validate($req, [
            'nama_barang' => 'required|string',
            'merek'       => 'required|string',
            'ram.*'       => 'required|string',
            'harga.*'     => 'required|numeric',
            'stok.*'      => 'required|numeric',
        ]);
        $barang = Barang::create([
            'nama_barang' => $req->nama_barang,
            'merek'       => $req->merek,
        ]);
        foreach ($req->ram as $i => $ram) {
            BarangVarian::create([
                'kd_barang' => $barang->kd_barang,
                'ram'       => $ram,
                'harga'     => $req->harga[$i],
                'stok'      => $req->stok[$i],
            ]);
        }

        return redirect('/barang/' . $req->locale)
            ->with('pesan', 'Data barang berhasil disimpan');
    }

//editbrg
    public function editbarang($id, $locale = 'id')
    {
        App::setLocale($locale);
        $barang = Barang::with('varian')->findOrFail($id);
        return view('editbarang', compact('barang', 'locale'));
    }

    public function updatebarang(Request $req, $id)
    {
        App::setLocale($req->locale);

        $this->validate($req, [
            'nama_barang' => 'required|string',
            'merek'       => 'required|string',
            'ram.*'       => 'required|string',
            'harga.*'     => 'required|numeric',
            'stok.*'      => 'required|numeric',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update([
            'nama_barang' => $req->nama_barang,
            'merek'       => $req->merek,
        ]);
        foreach ($req->id_varian as $i => $id_varian) {
            BarangVarian::where('id_varian', $id_varian)->update([
                'ram'   => $req->ram[$i],
                'harga' => $req->harga[$i],
                'stok'  => $req->stok[$i],
            ]);
        }

        return redirect('/barang/' . $req->locale)
            ->with('pesan', 'Data barang berhasil diperbarui');
    }

//delBarang
     public function deletebarang($id)
    {
        Barang::findOrFail($id)->delete();

        return redirect()->back()
            ->with('pesan', 'Data barang berhasil dihapus');
    }

//Penjualan
public function penjualan(Request $request, $locale = 'id')
{
    App::setLocale($locale);

    $query = Penjualan::with([
        'customer',
        'detail.barang',
        'detail.varian'
    ]);

    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->whereHas('customer', function ($qc) use ($request) {
                $qc->where('nama', 'like', '%'.$request->search.'%');
            })
            ->orWhere('tanggal', 'like', '%'.$request->search.'%');
        });
    }

    $data_penjualan = $query
        ->orderBy('tanggal', 'desc')
        ->get();

    return view('penjualan', compact('data_penjualan', 'locale'));
}


public function createpenjualan($locale = 'id')
{
    App::setLocale($locale);

    $customers = Customer::all();
    $barangs   = Barang::with('varian')->get();

    return view('createpenjualan', compact(
        'customers',
        'barangs',
        'locale'
    ));
}

public function savepenjualan(Request $req)
{
    App::setLocale($req->locale);

    $req->validate([
        'customer_id'    => 'required',
        'tanggal'        => 'required|date',
        'id_varian'      => 'required',
        'jumlah'         => 'required|numeric|min:1',
        'imei'           => 'required',
        'garansi_sampai' => 'required|date',
    ]);

    DB::beginTransaction();

    try {
        $varian = BarangVarian::findOrFail($req->id_varian);

        if ($req->jumlah > $varian->stok) {
            return back()->with('pesan', 'Stok tidak mencukupi');
        }
        $penjualan = Penjualan::create([
            'id_customer'  => $req->customer_id,
            'tanggal'      => $req->tanggal,
            'total_harga'  => 0
        ]);
        $subtotal = $varian->harga * $req->jumlah;
        PenjualanDetail::create([
            'id_penjualan'   => $penjualan->id_penjualan,
            'kd_barang'      => $varian->kd_barang,
            'id_varian'      => $varian->id_varian,
            'jumlah'         => $req->jumlah,
            'harga'          => $varian->harga,
            'imei'           => $req->imei,
            'garansi_sampai' => $req->garansi_sampai,
        ]);
        $penjualan->update([
            'total_harga' => $subtotal
        ]);

        // - stok
        $varian->stok -= $req->jumlah;
        $varian->save();
        DB::commit();
        return redirect('/penjualan/'.$req->locale)
            ->with('pesan', 'Data penjualan berhasil disimpan');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('pesan', $e->getMessage());
    }
}




//editpenjualan
public function editpenjualan($id, $locale = 'id')
{
    App::setLocale($locale);

    $penjualan = Penjualan::with('detail')->findOrFail($id);
    $detail    = $penjualan->detail->first(); 

    $customers = Customer::all();
    $barangs   = Barang::with('varian')->get();

    return view('editpenjualan', compact(
        'penjualan',
        'detail',
        'customers',
        'barangs',
        'locale'
    ));
}

//Updatepenjualan
public function updatepenjualan(Request $req, $id)
{
    App::setLocale($req->locale);

    $req->validate([
        'customer_id'     => 'required',
        'tanggal'         => 'required|date',
        'id_varian'       => 'required',
        'jumlah'          => 'required|numeric|min:1',
        'imei'            => 'required',
        'garansi_sampai'  => 'required|date',
    ]);

    DB::beginTransaction();

    try {

        $penjualan = Penjualan::findOrFail($id);
        $detail    = PenjualanDetail::where('id_penjualan', $id)->firstOrFail();
        $varian = BarangVarian::findOrFail($req->id_varian);
        $penjualan->update([
            'id_customer' => $req->customer_id,
            'tanggal'     => $req->tanggal,
            'total'       => $varian->harga * $req->jumlah
        ]);
        $detail->update([
            'kd_barang'      => $varian->kd_barang,
            'id_varian'      => $varian->id_varian,
            'jumlah'         => $req->jumlah,
            'harga'          => $varian->harga,
            'imei'           => $req->imei,
            'garansi_sampai' => $req->garansi_sampai,
        ]);

        DB::commit();

        return redirect('/penjualan/'.$req->locale)
            ->with('pesan', 'Data penjualan berhasil diperbarui');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('pesan', 'Terjadi kesalahan');
    }
}

//delpenjualan
public function deletepenjualan($id)
{
    Penjualan::findOrFail($id)->delete();

    return redirect()->back()
        ->with('pesan', 'Data penjualan berhasil dihapus');
}


//Laporan penjualan
public function laporanPenjualan(Request $request, $locale = 'id')
{
    App::setLocale($locale);

    $dari   = $request->dari;
    $sampai = $request->sampai;

    $query = PenjualanDetail::query()
        ->join('penjualan', 'penjualan.id_penjualan', '=', 'penjualan_detail.id_penjualan')
        ->join('customer', 'customer.id_customer', '=', 'penjualan.id_customer')
        ->join('barang_varian', 'barang_varian.id_varian', '=', 'penjualan_detail.id_varian')
        ->join('barang', 'barang.kd_barang', '=', 'barang_varian.kd_barang')
        ->select(
            'penjualan.tanggal',
            'customer.nama as customer_nama',
            'barang.nama_barang',
            'barang_varian.ram',
            'penjualan_detail.imei',
            'penjualan_detail.jumlah',
            DB::raw('(penjualan_detail.harga * penjualan_detail.jumlah) as total')
        );

    if ($dari && $sampai) {
        $query->whereBetween('penjualan.tanggal', [$dari, $sampai]);
    }

    $data = $query->orderBy('penjualan.tanggal', 'desc')->get();

    //data hitung 
    $totalPenjualan = $data->sum('total');
    $totalItem      = $data->sum('jumlah');

    return view('laporan_penjualan', compact(
        'data',
        'totalPenjualan',
        'totalItem',
        'dari',
        'sampai',
        'locale'
    ));
}

//dataservice
public function service(Request $request, $locale = 'id')
{
    \App::setLocale($locale);

    $query = Service::with(['customer', 'masterService']);

    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->whereHas('customer', function ($qc) use ($request) {
                $qc->where('nama', 'like', '%'.$request->search.'%');
            })
            ->orWhere('imei', 'like', '%'.$request->search.'%')
            ->orWhere('status', 'like', '%'.$request->search.'%');
        });
    }

    $data_service = $query
        ->orderBy('id_service', 'desc')
        ->get();

    return view('service', compact(
        'data_service',
        'locale'
    ));
}

public function createService($locale = 'id')
{
    \App::setLocale($locale);

    $customers = Customer::orderBy('nama')->get();
    $masterServices = MasterService::orderBy('nama_service')->get();

    return view('service_create', compact(
        'customers',
        'masterServices',
        'locale'
    ));
}

public function saveService(Request $request)
{
    \App::setLocale($request->locale);

    $request->validate([
        'id_customer' => 'required',
        'id_master_service' => 'required',
        'imei' => 'required|max:20',
        'tanggal_masuk' => 'required|date',
        'garansi_sampai' => 'nullable|date'
    ]);

    $master = MasterService::findOrFail($request->id_master_service);

    Service::create([
        'id_customer' => $request->id_customer,
        'id_master_service' => $request->id_master_service,
        'imei' => $request->imei,
        'tanggal_masuk' => $request->tanggal_masuk,
        'garansi_sampai' => $request->garansi_sampai,
        'status' => 'Masuk',
        'total_biaya' => $master->harga
    ]);

    return redirect()
        ->route('service', $request->locale)
        ->with('pesan', 'Data service berhasil ditambahkan');
}

public function editService($id, $locale = 'id')
{
    \App::setLocale($locale);

    $service = Service::with(['customer', 'masterService'])
        ->findOrFail($id);

    return view('service_edit', compact(
        'service',
        'locale'
    ));
}

public function updateService(Request $request, $id)
{
    App::setLocale($request->locale);

    $request->validate([
        'status' => 'required',
        'garansi_sampai' => 'nullable|date'
    ]);

    $service = Service::findOrFail($id);

    $service->status = $request->status;
    $service->garansi_sampai = $request->garansi_sampai;
    $service->save();

    return redirect()
        ->route('service', $request->locale)
        ->with('pesan', 'Data service berhasil diperbarui');
}

public function deleteService($id)
{
    Service::findOrFail($id)->delete();

    return redirect()->back()
        ->with('pesan', 'Data service berhasil dihapus');

}

//Master servic
public function masterService(Request $request, $locale = 'id')
{
    App::setLocale($locale);

    $query = MasterService::query();

    if ($request->search) {
        $query->where('nama_service', 'like', '%'.$request->search.'%')
              ->orWhere('harga', 'like', '%'.$request->search.'%');
    }

    $data = $query->orderBy('nama_service')->get();

    return view('master_service', compact('data','locale'));
}
public function createMasterService($locale = 'id')
{
    App::setLocale($locale);

    return view('master_service_create', compact('locale'));
}
public function storeMasterService(Request $request)
{
    App::setLocale($request->locale);

    $request->validate([
        'nama_service' => 'required',
        'harga'        => 'required|numeric|min:0'
    ]);

    MasterService::create([
        'nama_service' => $request->nama_service,
        'harga'        => $request->harga
    ]);

    return redirect()
        ->route('masterService', $request->locale)
        ->with('pesan', 'Master service berhasil ditambahkan');
}
public function editMasterService($id, $locale = 'id')
{
    App::setLocale($locale);

    $master = MasterService::findOrFail($id);

    return view('master_service_edit', compact('master','locale'));
}
public function updateMasterService(Request $request, $id)
{
    App::setLocale($request->locale);

    $request->validate([
        'nama_service' => 'required',
        'harga'        => 'required|numeric|min:0'
    ]);

    MasterService::where('id_master_service', $id)
        ->update([
            'nama_service' => $request->nama_service,
            'harga'        => $request->harga
        ]);

    return redirect()
        ->route('masterService', $request->locale)
        ->with('pesan', 'Master service berhasil diperbarui');
}
public function deleteMasterService($id)
{
    MasterService::findOrFail($id)->delete();

    return redirect()->back()
        ->with('pesan', 'Master service berhasil dihapus');
}


//Laporan servis
public function laporanService(Request $request, $locale = 'id')
{
    App::setLocale($locale);

    $dari   = $request->dari;
    $sampai = $request->sampai;

    $query = Service::with(['customer', 'masterService']);

    if ($dari && $sampai) {
        $query->whereBetween('tanggal_masuk', [$dari, $sampai]);
    }

    $data = $query
        ->orderBy('tanggal_masuk', 'asc')
        ->get();

    $totalService   = $data->count();
    $totalPendapatan = $data->sum('total_biaya');

    return view('laporan_service', compact(
        'data',
        'totalService',
        'totalPendapatan',
        'dari',
        'sampai',
        'locale'
    ));
}

//Laporan Pendapatan
    public function laporanPendapatan(Request $request, $locale = 'id')
    {
        App::setLocale($locale);

        $dari   = $request->dari;
        $sampai = $request->sampai;
        $qPenjualan = Penjualan::query();
        if ($dari && $sampai) {
            $qPenjualan->whereBetween('tanggal', [$dari, $sampai]);
        }
       $totalPenjualan = Penjualan::sum('total_harga');
        $qService = Service::query();
        if ($dari && $sampai) {
            $qService->whereBetween('tanggal_masuk', [$dari, $sampai]);
        }
        $totalService = $qService->sum('total_biaya');

        $grandTotal = $totalPenjualan + $totalService;

        return view('laporan_pendapatan', compact(
            'totalPenjualan',
            'totalService',
            'grandTotal',
            'dari',
            'sampai',
            'locale'
        ));
    }

public function topCustomer(Request $request, $locale = 'id')
{
    App::setLocale($locale);

    $dari   = $request->dari;
    $sampai = $request->sampai;


//tot Penjualan
    $penjualan = DB::table('penjualan')
        ->select(
            'id_customer',
            DB::raw('COUNT(id_penjualan) as total_beli_hp')
        )
        ->when($dari && $sampai, function ($q) use ($dari, $sampai) {
            $q->whereBetween('tanggal', [$dari, $sampai]);
        })
        ->groupBy('id_customer');

//tot service
    $service = DB::table('service')
        ->select(
            'id_customer',
            DB::raw('COUNT(id_service) as total_service')
        )
        ->when($dari && $sampai, function ($q) use ($dari, $sampai) {
            $q->whereBetween('tanggal_masuk', [$dari, $sampai]);
        })
        ->groupBy('id_customer');

        //jual+ser
    $data = DB::table('customer')
        ->leftJoinSub($penjualan, 'p', function ($join) {
            $join->on('customer.id_customer', '=', 'p.id_customer');
        })
        ->leftJoinSub($service, 's', function ($join) {
            $join->on('customer.id_customer', '=', 's.id_customer');
        })
        ->select(
            'customer.id_customer',
            'customer.nama',
            DB::raw('COALESCE(p.total_beli_hp, 0) as total_beli_hp'),
            DB::raw('COALESCE(s.total_service, 0) as total_service'),
            DB::raw('
                COALESCE(p.total_beli_hp, 0)
              + COALESCE(s.total_service, 0)
              as total_transaksi
            ')
        )
        ->orderByDesc('total_transaksi')
        ->get();

    return view('top_customer', compact(
        'data',
        'dari',
        'sampai',
        'locale'
    ));
}
}