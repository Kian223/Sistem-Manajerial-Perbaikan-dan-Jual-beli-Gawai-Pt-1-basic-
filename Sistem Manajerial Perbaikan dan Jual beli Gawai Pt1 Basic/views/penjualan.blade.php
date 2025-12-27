@extends('master')
@section('title', __('table.penjualan.title'))

@section('content')

@if(Session::has('pesan'))
  <div class="alert alert-success">
    {{ Session::get('pesan') }}
  </div>
@endif

<div class="container mt-3">

  <h2>
    <i class="bi bi-receipt"></i> {{ __('table.penjualan.title') }}
  </h2>
  <form method="GET"
        action="{{ url('/penjualan/'.app()->getLocale()) }}"
        class="mb-3">
    <div class="row">
      <div class="col-md-4">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               class="form-control"
               placeholder="{{ __('table.penjualan.search') }}">
      </div>
      <div class="col-md-4">
        <button class="btn btn-primary">
          🔍 {{ __('Search') }}
        </button>
        <a href="{{ url('/penjualan/'.app()->getLocale()) }}"
           class="btn btn-secondary">
          {{ __('Reset') }}
        </a>
      </div>
    </div>
  </form>

  <p>
    <a href="{{ route('createpenjualan', app()->getLocale()) }}">
      <button class="btn btn-success mb-2">
        {{ __('table.penjualan.tambah') }}
      </button>
    </a>
  </p>

  <table class="table table-hover shadow-sm rounded">
    <thead class="table-dark">
      <tr class="text-center">
        <th>No</th>
        <th>{{ __('table.penjualan.tanggal') }}</th>
        <th>{{ __('table.penjualan.customer') }}</th>
        <th>{{ __('table.penjualan.barang') }}</th>
        <th>{{ __('table.penjualan.varian') }}</th>
        <th>IMEI</th>
        <th>{{ __('table.penjualan.garansi') }}</th>
        <th>{{ __('table.penjualan.total_item') }}</th>
        <th>{{ __('table.penjualan.edit') }}</th>
        <th>{{ __('table.penjualan.hapus') }}</th>
      </tr>
    </thead>

    <tbody>
    @forelse ($data_penjualan as $p)
      @php
        $detail = $p->detail->first();
      @endphp
      <tr>
        <td class="text-center">{{ $loop->iteration }}</td>

        <td class="text-center">
          {{ date('d-m-Y', strtotime($p->tanggal)) }}
        </td>

        <td>
          {{ optional($p->customer)->nama ?? '-' }}
        </td>

        <td>
          {{ optional(optional($detail)->barang)->nama_barang ?? '-' }}
        </td>

        <td class="text-center">
          {{ optional(optional($detail)->varian)->ram ?? '-' }}
        </td>

        <td class="text-center">
          {{ optional($detail)->imei ?? '-' }}
        </td>

        <td class="text-center">
          {{ optional($detail)->garansi_sampai ?? '-' }}
        </td>

        <td class="text-center">
          {{ optional($detail)->jumlah ?? 0 }}
        </td>

        <td class="text-center">
          <a href="{{ route('editpenjualan', [$p->id_penjualan, app()->getLocale()]) }}"
             class="btn btn-primary btn-sm">
            {{ __('table.penjualan.edit') }}
          </a>
        </td>

        <td class="text-center">
          <form action="{{ route('deletepenjualan', $p->id_penjualan) }}"
                method="POST">
            @csrf
            <button class="btn btn-danger btn-sm"
              onclick="return confirm('{{ __('table.penjualan.confirm') }}')">
              {{ __('table.penjualan.hapus') }}
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="10" class="text-center text-muted">
          {{ __('table.penjualan.kosong') }}
        </td>
      </tr>
    @endforelse
    </tbody>
  </table>

  <a href="/penjualan/en">English</a> |
  <a href="/penjualan/id">Indonesia</a>

</div>
@endsection
