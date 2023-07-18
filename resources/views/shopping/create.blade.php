@extends('layouts.main')

@section('container')

<h2 class="my-3">Keranjang</h2>

<form action="" method="post">
    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">List Barang</label>
        <div class="col-sm-10">
            <ol>
                @foreach ($data as $d)
                <li>{{ $d->joinBarang->nama_barang }}</li>
                @endforeach
            </ol>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Subtotal</label>
        <div class="col-sm-10">
            <ol>
                @foreach ($data as $d)
                <li>Rp {{ number_format($d->joinBarang->harga_barang,0,',','.') }}</li>
                @endforeach
            </ol>
        </div>
    </div>

        <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Total Harga</label>
        <div class="col-sm-10">
            <p class="ms-3">Rp {{ number_format(($data->first()->total_harga ?? null),0,',','.') }}</p>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Diskon voucher</label>
        <div class="col-sm-10">
            <p class="ms-3">Rp {{ number_format(($data->first()->diskon_voucher ?? null),0,',','.') }}</p>
        </div>
    </div>

    <hr class="my-3">

    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Total Belanja</label>
        <div class="col-sm-10">
            <p class="ms-3">Rp {{ number_format(($data->first()->total_belanja ?? null),0,',','.') }}</p>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Kode Voucher</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="inputPassword" value="{{ $kode_voucher }}" readonly>
            @if (!is_null($kode_voucher))
            <p class="text-danger">Voucher berlaku 3 bulan</p>
            @endif
            @if (($data->first()->total_harga ?? 0)>=2000000)
            <a href="/pakaivoucher" class="btn btn-info my-2 text-light">Pakai voucher</a>
            <a href="/batalvoucher" class="btn btn-secondary my-2 text-light">Batal</a>
            @else
            <button class="btn btn-secondary" disabled>Pakai voucher</button>
            <button class="btn btn-secondary" disabled>Batal</button>
            @endif
        </div>
    </div>
        <a href="/checkout" class="btn btn-primary mt-4">Checkout</a>
</form>

@endsection

