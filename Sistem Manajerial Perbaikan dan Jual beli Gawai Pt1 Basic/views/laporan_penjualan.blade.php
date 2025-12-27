@extends('master')
@section('title', __('laporan.penjualan.title'))

@section('content')

<div class="container mt-4">

  <h3 class="mb-3">
    <i class="bi bi-clipboard-data"></i> {{ __('laporan.penjualan.title') }}
  </h3>

  <form method="GET"
        action="{{ route('laporan.penjualan', $locale) }}"
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
        <i class="bi bi-search"></i> {{ __('laporan.penjualan.filter') }}
      </button>

      <a href="{{ route('laporan.penjualan', $locale) }}"
         class="btn btn-secondary">
        Reset
      </a>
    </div>
  </form>

  <div class="row mb-3">
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <h4>Rp {{ number_format($totalPenjualan,0,',','.') }}</h4>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <h6>{{ __('laporan.penjualan.total_item') }}</h6>
          <h4>{{ $totalItem }}</h4>
        </div>
      </div>
    </div>
  </div>

  <table class="table table-bordered table-hover">
    <thead class="table-dark text-center">
      <tr>
        <th>No</th>
        <th>{{ __('laporan.penjualan.tanggal') }}</th>
        <th>{{ __('laporan.penjualan.customer') }}</th>
        <th>{{ __('laporan.penjualan.barang') }}</th>
        <th>{{ __('laporan.penjualan.varian') }}</th>
        <th>IMEI</th>
        <th>{{ __('laporan.penjualan.jumlah') }}</th>
        <th>{{ __('laporan.penjualan.total') }}</th>
      </tr>
    </thead>

    <tbody>
    @forelse($data as $row)
      <tr>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td>{{ $row->tanggal }}</td>
        <td>{{ $row->customer_nama }}</td>
        <td>{{ $row->nama_barang }}</td>
        <td>{{ $row->ram }}</td>
        <td>{{ $row->imei }}</td>
        <td class="text-center">{{ $row->jumlah }}</td>
        <td class="text-end">
          Rp {{ number_format($row->total,0,',','.') }}
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="8" class="text-center text-muted">
          {{ __('laporan.penjualan.kosong') }}
        </td>
      </tr>
    @endforelse
    </tbody>
  </table>

  <h6>{{ __('laporan.penjualan.total_penjualan') }}</h6>
  <div class="mt-3 text-end">
    <a href="{{ route('laporan.penjualan','id') }}">Indonesia</a> |
    <a href="{{ route('laporan.penjualan','en') }}">English</a>
  </div>

</div>
@endsection
