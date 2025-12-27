@extends('master')
@section('title', __('Laporan Service'))

@section('content')

<div class="container mt-4">

  <h3 class="mb-3">
    <i class="bi bi-clipboard-data"></i> Laporan Service
  </h3>
  <form method="GET"
        action="{{ route('laporanService', $locale) }}"
        class="row g-2 mb-3">

    <div class="col-md-3">
      <input type="date"
             name="dari"
             class="form-control"
             value="{{ $dari }}">
    </div>

    <div class="col-md-3">
      <input type="date"
             name="sampai"
             class="form-control"
             value="{{ $sampai }}">
    </div>

    <div class="col-md-4">
      <button class="btn btn-primary">
        <i class="bi bi-search"></i> Filter
      </button>

      <a href="{{ route('laporanService', $locale) }}"
         class="btn btn-secondary">
        Reset
      </a>
    </div>
  </form>
  <div class="row mb-3">
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <h6>Total Service</h6>
          <h4>{{ $totalService }}</h4>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <h6>Total Pendapatan</h6>
          <h4>
            Rp {{ number_format($totalPendapatan,0,',','.') }}
          </h4>
        </div>
      </div>
    </div>
  </div>

  {{-- TABLE --}}
  <table class="table table-bordered table-hover">
    <thead class="table-dark text-center">
      <tr>
        <th>No</th>
        <th>Tanggal Masuk</th>
        <th>Customer</th>
        <th>Jenis Service</th>
        <th>IMEI</th>
        <th>Status</th>
        <th>Total Biaya</th>
      </tr>
    </thead>

    <tbody>
    @forelse ($data as $s)
      <tr>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td>{{ $s->tanggal_masuk }}</td>
        <td>{{ $s->customer->nama }}</td>
        <td>{{ $s->masterService->nama_service }}</td>
        <td>{{ $s->imei }}</td>
        <td class="text-center">
          <span class="badge bg-info">
            {{ $s->status }}
          </span>
        </td>
        <td class="text-end">
          Rp {{ number_format($s->total_biaya,0,',','.') }}
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="7" class="text-center text-muted">
          Data tidak ditemukan
        </td>
      </tr>
    @endforelse
    </tbody>
  </table>

  {{-- LANGUAGE --}}
  <div class="mt-3 text-end">
    <a href="{{ route('laporanService','en') }}">English</a> |
    <a href="{{ route('laporanService','id') }}">Indonesia</a>
  </div>

</div>
@endsection
