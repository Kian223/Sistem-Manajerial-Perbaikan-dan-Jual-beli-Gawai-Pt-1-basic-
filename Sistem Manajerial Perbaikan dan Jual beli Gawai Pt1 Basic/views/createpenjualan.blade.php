@extends('master')
@section('title', __('form.penjualan.title'))

@section('content')
<div class="container mt-4 mb-4">

  <div class="card shadow-sm border-0">
    <div class="card-header bg-dark text-white">
      <h5 class="mb-0">
        <i class="bi bi-receipt"></i>
        {{ __('form.penjualan.title') }}
      </h5>
    </div>

    <div class="card-body">
      @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
      <form method="POST" action="{{ route('savepenjualan') }}">
        @csrf
        <input type="hidden" name="locale" value="{{ $locale }}">
        <div class="mb-3">
          <label class="form-label fw-semibold">
            {{ __('form.penjualan.customer') }}
          </label>
          <select name="customer_id" class="form-control" required>
            <option value="">
              -- {{ __('form.penjualan.pilih_customer') }} --
            </option>
            @foreach ($customers as $c)
              <option value="{{ $c->id_customer }}"
                {{ old('customer_id') == $c->id_customer ? 'selected' : '' }}>
                {{ $c->nama }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">
            {{ __('form.penjualan.barang') }}
          </label>
          <select name="id_varian" class="form-control" required>
            <option value="">
              -- {{ __('form.penjualan.pilih_barang') }} --
            </option>
            @foreach($barangs as $b)
              @foreach($b->varian as $v)
                <option value="{{ $v->id_varian }}"
                        {{ old('id_varian') == $v->id_varian ? 'selected' : '' }}>
                  {{ $b->nama_barang }} - {{ $v->ram }}
                  ({{ __('form.penjualan.stok') }}: {{ $v->stok }})
                </option>
              @endforeach
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">
            {{ __('form.penjualan.jumlah') }}
          </label>
          <input type="number"
                 name="jumlah"
                 class="form-control"
                 min="1"
                 value="{{ old('jumlah') }}"
                 required>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">
            IMEI
          </label>
          <input type="text"
                 name="imei"
                 class="form-control"
                 maxlength="20"
                 value="{{ old('imei') }}"
                 required>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">
            {{ __('Garansi') }}
          </label>
          <input type="date"
                 name="garansi_sampai"
                 class="form-control"
                 value="{{ old('garansi_sampai') }}"
                 required>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">
            {{ __('form.penjualan.tanggal') }}
          </label>
          <input type="date"
                 name="tanggal"
                 class="form-control"
                 value="{{ old('tanggal') }}"
                 required>
        </div>
        <hr>
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <button class="btn btn-success">
              <i class="bi bi-save"></i>
              {{ __('form.penjualan.simpan') }}
            </button>

            <a href="{{ route('penjualan', $locale) }}"
               class="btn btn-secondary">
              {{ __('form.back') }}
            </a>
          </div>
        </div>

      </form>

    </div>
  </div>
  <div class="mt-3 text-end">
    <a href="{{ route('createpenjualan','en') }}">English</a> |
    <a href="{{ route('createpenjualan','id') }}">Indonesia</a>
  </div>

</div>
@endsection
