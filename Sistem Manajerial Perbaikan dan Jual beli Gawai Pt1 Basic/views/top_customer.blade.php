@extends('master')
@section('title', __('laporan.top_customer.title'))

@section('content')
<div class="container mt-4">

<div class="card shadow-sm border-0">
  <div class="card-header bg-dark text-white">
    <h5 class="mb-0">
      {{ __('laporan.top_customer.title') }}
    </h5>
  </div>

  <div class="card-body">

    {{-- FILTER --}}
    <form method="GET" class="row g-2 mb-4">
      <div class="col-md-3">
        <input type="date"
               name="dari"
               value="{{ $dari }}"
               class="form-control">
      </div>
      <div class="col-md-3">
        <input type="date"
               name="sampai"
               value="{{ $sampai }}"
               class="form-control">
      </div>
      <div class="col-md-3">
        <button class="btn btn-primary">
          {{ __('filter') }}
        </button>
      </div>
    </form>

    {{-- SUMMARY --}}
    @php
      $totalTransaksi = $data->sum('total_transaksi');
    @endphp

    <div class="alert alert-success mb-3">
      <strong>{{ __('laporan.top_customer.total_transaksi') }}:</strong>
      {{ $totalTransaksi }}
    </div>

    {{-- TABLE --}}
    <table class="table table-bordered table-hover">
      <thead class="table-dark text-center">
        <tr>
          <th width="60">#</th>
          <th>{{ __('laporan.top_customer.nama') }}</th>
          <th width="150">{{ __('laporan.top_customer.beli_hp') }}</th>
          <th width="150">{{ __('laporan.top_customer.service') }}</th>
          <th width="180">{{ __('laporan.top_customer.total') }}</th>
        </tr>
      </thead>

      <tbody>
      @php $rank = 1; @endphp
      @forelse ($data as $row)
        <tr>
          <td class="text-center">
            @if ($rank == 1)
              🥇
            @elseif ($rank == 2)
              🥈
            @elseif ($rank == 3)
              🥉
            @else
              {{ $rank }}
            @endif
          </td>

          <td>{{ $row->nama }}</td>

          <td class="text-center">
            {{ $row->total_beli_hp }}
          </td>

          <td class="text-center">
            {{ $row->total_service }}
          </td>

          <td class="text-center fw-bold">
            {{ $row->total_transaksi }}
          </td>
        </tr>
        @php $rank++; @endphp
      @empty
        <tr>
          <td colspan="5" class="text-center text-muted">
            {{ __('laporan.top_customer.kosong') }}
          </td>
        </tr>
      @endforelse
      </tbody>
    </table>

  </div>
</div>

<div class="mt-3 text-end">
  <a href="{{ route('topCustomer','id') }}">Indonesia</a> |
  <a href="{{ route('topCustomer','en') }}">English</a>
</div>

</div>
@endsection
