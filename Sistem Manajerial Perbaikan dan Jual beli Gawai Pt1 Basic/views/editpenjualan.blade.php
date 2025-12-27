@extends('master')
@section('title', __('ubah.penjualan.title'))

@section('content')
<div class="container mt-4 mb-4">

  <div class="card shadow-sm border-0">
    <div class="card-header bg-dark text-white">
      <h5 class="mb-0">
        <i class="bi bi-pencil-square"></i>
        {{ __('ubah.penjualan.title') }}
      </h5>
    </div>

    <div class="card-body">

      <form method="POST"
            action="{{ route('updatepenjualan', $penjualan->id_penjualan) }}">
        @csrf
        <input type="hidden" name="locale" value="{{ $locale }}">
        <div class="mb-3">
          <label class="form-label fw-semibold">
            {{ __('ubah.penjualan.customer') }}
          </label>
          <select name="customer_id" class="form-control" required>
            @foreach($customers as $c)
              <option value="{{ $c->id_customer }}"
                {{ $penjualan->id_customer == $c->id_customer ? 'selected' : '' }}>
                {{ $c->nama }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">
            {{ __('ubah.penjualan.tanggal') }}
          </label>
          <input type="date"
                 name="tanggal"
                 class="form-control"
                 value="{{ $penjualan->tanggal }}"
                 required>
        </div>
        <hr>
        <h6 class="fw-bold mb-3">
          <i class="bi bi-phone"></i>
          {{ __('ubah.penjualan.detail_barang') }}
        </h6>
        <div class="mb-3">
          <label class="form-label fw-semibold">
            {{ __('ubah.penjualan.barang') }}
          </label>
          <select name="id_varian" class="form-control" required>
            @foreach($barangs as $b)
              @foreach($b->varian as $v)
                <option value="{{ $v->id_varian }}"
                  {{ optional($detail)->id_varian == $v->id_varian ? 'selected' : '' }}>
                  {{ $b->nama_barang }} - {{ $v->ram }}
                </option>
              @endforeach
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">
            {{ __('ubah.penjualan.jumlah') }}
          </label>
          <input type="number"
                 name="jumlah"
                 class="form-control"
                 value="{{ optional($detail)->jumlah ?? 1 }}"
                 min="1"
                 required>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">
            IMEI
          </label>
          <input type="text"
                 name="imei"
                 class="form-control"
                 value="{{ optional($detail)->imei }}"
                 required>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">
            {{ __('ubah.penjualan.garansi') }}
          </label>
          <input type="date"
                 name="garansi_sampai"
                 class="form-control"
                 value="{{ optional($detail)->garansi_sampai }}"
                 required>
        </div>
        <hr>
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <button class="btn btn-success">
              <i class="bi bi-save"></i>
              {{ __('ubah.penjualan.update') }}
            </button>

            <a href="{{ route('penjualan', $locale) }}"
               class="btn btn-secondary">
              {{ __('ubah.penjualan.kembali') }}
            </a>
          </div>
        </div>

      </form>

    </div>
  </div>
  <div class="mt-3 text-end">
    <a href="{{ route('editpenjualan', [$penjualan->id_penjualan, 'en']) }}">English</a> |
    <a href="{{ route('editpenjualan', [$penjualan->id_penjualan, 'id']) }}">Indonesia</a>
  </div>

</div>
@endsection
