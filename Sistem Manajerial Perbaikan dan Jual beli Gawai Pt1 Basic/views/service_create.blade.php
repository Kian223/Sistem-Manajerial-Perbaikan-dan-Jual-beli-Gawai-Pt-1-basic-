@extends('master')
@section('title', 'Form Service')

@section('content')
<div class="container mt-4 mb-4">

  <div class="card shadow-sm border-0">
    <div class="card-header bg-dark text-white">
      <h5 class="mb-0">
        <i class="bi bi-tools"></i>
        Form Service
      </h5>
    </div>

    <div class="card-body">

      <form method="POST" action="{{ route('saveService') }}">
        @csrf
        <input type="hidden" name="locale" value="{{ $locale }}">

        <div class="mb-3">
          <label class="form-label fw-semibold">Customer</label>
          <select name="id_customer" class="form-control" required>
            <option value="">-- Pilih Customer --</option>
            @foreach($customers as $c)
              <option value="{{ $c->id_customer }}">{{ $c->nama }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Jenis Service</label>
          <select name="id_master_service" class="form-control" required>
            <option value="">-- Pilih Jenis Service --</option>
            @foreach($masterServices as $m)
              <option value="{{ $m->id_master_service }}">
                {{ $m->nama_service }} (Rp {{ number_format($m->harga,0,',','.') }})
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">IMEI</label>
          <input type="text" name="imei" class="form-control" maxlength="20" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Tanggal Masuk</label>
          <input type="date" name="tanggal_masuk" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Garansi Sampai</label>
          <input type="date" name="garansi_sampai" class="form-control">
        </div>

        <hr>

        <div class="d-flex justify-content-between">
          <button class="btn btn-success">
            <i class="bi bi-save"></i> Simpan
          </button>

          <a href="{{ route('service', $locale) }}" class="btn btn-secondary">
            Kembali
          </a>
        </div>

      </form>

    </div>
  </div>

  <div class="mt-3 text-end">
    <a href="{{ route('createService','en') }}">English</a> |
    <a href="{{ route('createService','id') }}">Indonesia</a>
  </div>

</div>
@endsection