<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Voucher;
use App\Models\Keranjang;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKeranjangRequest;
use App\Http\Requests\UpdateKeranjangRequest;

use function PHPUnit\Framework\isNull;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voucherAktif = Voucher::where('expired_date', '>', Carbon::now()->toDateString())->whereNull('is_voucher_dipakai')->first();
        return view('shopping/create', [
            "title" => "Keranjang",
            "data" => Keranjang::whereNull('is_sudah_checkout')->with(['joinBarang'])->get(),
            "kode_voucher" => $voucherAktif->kode_voucher ?? null
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $barang_id = $request->barang_id;
        $barangIdSebelumnya = Keranjang::whereNull('is_sudah_checkout')->get('barang_id')->toArray();
        $barangIdSebelumnya[] = $barang_id;

        // $totalHargaSemuaBarang = Barang::whereIn('id', $barangIdSebelumnya)->get()->sum('harga_barang');

        $totalHargaBarangSebelumnya = Keranjang::whereNull('is_sudah_checkout')->first()->total_harga ?? 0;
        $hargaBarangBaru = Barang::find($barang_id)->harga_barang ?? 0;
        $totalHargaSemuaBarang = $totalHargaBarangSebelumnya + $hargaBarangBaru;

        $kodevoucher = null;

        if ($totalHargaSemuaBarang >= 2000000) {
            $voucherAktif = Voucher::where('expired_date', '>', Carbon::now()->toDateString())->whereNull('is_voucher_dipakai')->first();
            if (is_null($voucherAktif)) {
                Voucher::truncate();
                Voucher::insert([
                    'kode_voucher' => Str::random(10),
                    'expired_date' => Carbon::now()->addMonths(3)
                ]);

                $kodevoucher = Voucher::first()->kode_voucher;
            } else {
                $kodevoucher = $voucherAktif->kode_voucher;
            }
        }

        Keranjang::insert([
            'barang_id' => $barang_id,
            'total_harga' => 0,
            'total_belanja' => 0
        ]);

        Keranjang::whereNull('is_sudah_checkout')->update([
            'total_harga' => $totalHargaSemuaBarang,
            'total_belanja' => $totalHargaSemuaBarang,
        ]);

        return view('home', [
            "title" => "Home",
            "data" => Barang::all(),
            "kode_voucher" => $kodevoucher
        ]);
    }

    public function pakaivoucher()
    {
        $diskonVoucher = 10000;

        $totalHargaSemuaBarang = Keranjang::whereNull('is_sudah_checkout')->first()->total_harga ?? 0;

        $voucherAktif = Voucher::where('expired_date', '>', Carbon::now()->toDateString())->whereNull('is_voucher_dipakai')->first();

        Keranjang::whereNull('is_sudah_checkout')->update([
            'diskon_voucher' => $diskonVoucher,
            'total_belanja' => $totalHargaSemuaBarang - intval($diskonVoucher),
            'voucher_id' => $voucherAktif->id
        ]);

        return view('shopping/create', [
            "title" => "Keranjang",
            "data" => Keranjang::whereNull('is_sudah_checkout')->with(['joinBarang'])->get(),
            "kode_voucher" => $voucherAktif->kode_voucher ?? null
        ]);
    }

    public function batalvoucher()
    {
        $diskonVoucher = 10000;

        $totalHargaSemuaBarang = Keranjang::whereNull('is_sudah_checkout')->first()->total_harga ?? 0;

        $voucherAktif = Voucher::where('expired_date', '>', Carbon::now()->toDateString())->whereNull('is_voucher_dipakai')->first();

        Keranjang::whereNull('is_sudah_checkout')->update([
            'diskon_voucher' => null,
            'total_belanja' => $totalHargaSemuaBarang,
            'voucher_id' => null
        ]);

        return view('shopping/create', [
            "title" => "Keranjang",
            "data" => Keranjang::whereNull('is_sudah_checkout')->with(['joinBarang'])->get(),
            "kode_voucher" => $voucherAktif->kode_voucher ?? null
        ]);
    }

    public function checkout()
    {
        $keranjangAktif = Keranjang::whereNull('is_sudah_checkout')->first();

        $barangIdSebelumnya = Keranjang::whereNull('is_sudah_checkout')->get('barang_id')->toArray();
        $totalHargaSemuaBarang = Keranjang::whereNull('is_sudah_checkout')->first()->total_harga ?? 0;

        Keranjang::whereNull('is_sudah_checkout')->update([
            'is_sudah_checkout' => 1,
            'tgl_checkout' => Carbon::now()->toDateString()
        ]);

        if ($totalHargaSemuaBarang >= 2000000 && !is_null($keranjangAktif->voucher_id)) {
            $voucher = Voucher::find($keranjangAktif->voucher_id);
            $voucher->is_voucher_dipakai = 1;
            $voucher->save();
        }

        $keranjangRiwayat = Keranjang::whereNotNull('is_sudah_checkout')->get();
        $voucherAktif = Voucher::where('expired_date', '>', Carbon::now()->toDateString())->whereNull('is_voucher_dipakai')->first();
        return view('about', [
            'riwayat' => $keranjangRiwayat,
            'voucher' => $voucherAktif,
            "title" => "Akun",
            "name" => "Romadloni",
            "email" => "romadloniputra@gmail.com",
            "image" => "romadloni.jpg"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Keranjang $keranjang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keranjang $keranjang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeranjangRequest $request, Keranjang $keranjang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keranjang $keranjang)
    {
        //
    }
}
