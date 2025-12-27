@extends('master')
@section('title', __('laporan.pendapatan.title'))

@section('content')
<div class="container mt-4">

<div class="card shadow-sm border-0">
<div class="card-header bg-dark text-white">
  <h5 class="mb-0">
    <i class="bi bi-cash-stack"></i>
    {{ __('laporan.pendapatan.title') }}
  </h5>
</div>
<div class="card-body">
<form method="GET" class="row g-2 mb-4">
  <div class="col-md-3">
    <input type="date" name="dari" value="{{ $dari }}" class="form-control">
  </div>
  <div class="col-md-3">
    <input type="date" name="sampai" value="{{ $sampai }}" class="form-control">
  </div>
  <div class="col-md-3">
    <button class="btn btn-primary">
      {{ __('laporan.filter') }}
    </button>
  </div>
</form>

<div class="row">

  <div class="col-md-4">
    <div class="alert alert-info">
      <strong>{{ __('laporan.pendapatan.penjualan') }}</strong><br>
      Rp {{ number_format($totalPenjualan,0,',','.') }}
    </div>
  </div>

  <div class="col-md-4">
    <div class="alert alert-warning">
      <strong>{{ __('laporan.pendapatan.service') }}</strong><br>
      Rp {{ number_format($totalService,0,',','.') }}
    </div>
  </div>

  <div class="col-md-4">
    <div class="alert alert-success">
      <strong>{{ __('laporan.pendapatan.total') }}</strong><br>
      Rp {{ number_format($grandTotal,0,',','.') }}
    </div>
  </div>
</div>
</div>
</div>
<div class="mt-3 text-end">
  <a href="{{ route('laporan.pendapatan','id') }}">Indonesia</a> |
  <a href="{{ route('laporan.pendapatan','en') }}">English</a>
</div>

</div>
@endsection
