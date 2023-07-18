@extends('layouts/main')    

@section('container')

<div class="col-lg-6 mt-5">
    <div class="card p-3">
        <h3 class="text-center mb-4">Akun Blonjo</h3>
        <div class="row">
            <div class="col-md-5">
                <img src="image/{{ $image }}" alt="<{{ $name }}" style="width: 10rem" class="thumbnail rounded-pill">
            </div>
            <div class="col-md-7 my-3">
                <h5 class="">{{ $name }}</h1>
                <h5>{{ $email }}</h5>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6 my-5">
    <h2 class="my-4">Voucher</h2>
    <div class="card p-4">
        <h4>Voucher Tersimpan: {{ $voucher->kode_voucher ?? null }}</h4>
        <p class="text-danger">Expired date: {{ $voucher->expired_date ?? null }}</p>
    </div>
</div>

{{-- <div class="my-5">
    <h3 class="my-4">Riwayat Belanja</h3>
    <div class="col-lg-6">
        <div class="card p-4">
            <table class="table table-borderless">
                <tbody>
                  <tr>
                    <td>Tanggal Checkout</td>
                    <td>18/7/2023</td>
                  </tr>
                  <tr>
                    <td>List Barang</td>
                    <td>Sepatu</td>
                    
                  </tr>
                  <tr>
                    <td></td>
                    <td>Baju</td>
                  </tr>
                  <tr>
                    <td>Total Belanja</td>
                    <td>Rp. 2.000.000</td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>
</div> --}}

@endsection

