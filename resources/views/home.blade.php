@extends('layouts.main')

@section('container')

<h2 class="my-4">Belanja apapun jadi checkout</h2>

<div class="d-flex flex-wrap">
    @foreach ($data as $d)
    <div class="card m-2" style="width: 18rem;">
        <img src="image/{{ $d->foto }}" alt="" class="card-img-top img-shop">
        <div class="card-body">
            <h5 class="card-title">{{ $d->nama_barang }}</h5>
            <h4>Rp {{ number_format($d->harga_barang,0,',','.') }}</h4>
            <div class="d-flex justify-content-end">
                <a href="/masukkeranjang?barang_id={{ $d->id }}" class="btn btn-primary m-3">Keranjang</a>                
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection

