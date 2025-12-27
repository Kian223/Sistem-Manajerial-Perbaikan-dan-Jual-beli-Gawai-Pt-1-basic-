@extends('master')
@section('title', __('table.service.title'))

@section('content')

@if(Session::has('pesan'))
  <div class="alert alert-success">
    {{ Session::get('pesan') }}
  </div>
@endif

<div class="container mt-4">

  <h2 class="mb-3">
    <i class="fa-solid fa-screwdriver-wrench"></i>
    {{ __('table.service.title') }}
  </h2>

  <form method="GET"
        action="{{ route('service', app()->getLocale()) }}"
        class="mb-3">
    <div class="row">
      <div class="col-md-4">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               class="form-control"
               placeholder="{{ __('table.service.search') }}">
      </div>
      <div class="col-md-4">
        <button class="btn btn-primary">
          <i class="fa-solid fa-magnifying-glass"></i>
          {{ __('search') }}
        </button>
        <a href="{{ route('service', app()->getLocale()) }}"
           class="btn btn-secondary">
          <i class="fa-solid fa-rotate-left"></i>
          {{ __('reset') }}
        </a>
      </div>
    </div>
  </form>

  <p>
    <a href="{{ route('createService', app()->getLocale()) }}"
       class="btn btn-success mb-2">
      <i class="fa-solid fa-plus"></i>
      {{ __('table.service.tambah') }}
    </a>
  </p>

  <table class="table table-hover shadow-sm rounded">
    <thead class="table-dark text-center">
      <tr>
        <th>No</th>
        <th>{{ __('table.service.tanggal') }}</th>
        <th>{{ __('table.service.customer') }}</th>
        <th>{{ __('table.service.jenis') }}</th>
        <th>IMEI</th>
        <th>{{ __('table.service.garansi') }}</th>
        <th>{{ __('table.service.status') }}</th>
        <th>{{ __('table.service.total') }}</th>
        <th>{{ __('table.service.aksi') }}</th>
      </tr>
    </thead>

    <tbody>
    @forelse ($data_service as $s)
      <tr>
        <td class="text-center">{{ $loop->iteration }}</td>

        <td class="text-center">
          {{ date('d-m-Y', strtotime($s->tanggal_masuk)) }}
        </td>

        <td>{{ optional($s->customer)->nama }}</td>

        <td>{{ optional($s->masterService)->nama_service }}</td>

        <td class="text-center">{{ $s->imei }}</td>

        <td class="text-center">
          {{ $s->garansi_sampai
              ? date('d-m-Y', strtotime($s->garansi_sampai))
              : '-' }}
        </td>
        <td class="text-center">
          @if ($s->status == 'Masuk')
            <span class="badge bg-secondary">
              <i class="fa-solid fa-inbox"></i>
              {{ __('table.service.status_Masuk') }}
            </span>
          @elseif ($s->status == 'Proses')
            <span class="badge bg-warning text-dark">
              <i class="fa-solid fa-spinner"></i>
              {{ __('table.service.status_Proses') }}
            </span>
          @elseif ($s->status == 'Selesai')
            <span class="badge bg-success">
              <i class="fa-solid fa-check"></i>
              {{ __('table.service.status_Selesai') }}
            </span>
          @else
            <span class="badge bg-primary">
              <i class="fa-solid fa-box"></i>
              {{ __('table.service.status_Diambil') }}
            </span>
          @endif
        </td>

        <td class="text-end">
          Rp {{ number_format($s->total_biaya,0,',','.') }}
        </td>
        <td class="text-center">
          <a href="{{ route('editService', [$s->id_service, app()->getLocale()]) }}"
             class="btn btn-sm btn-primary">
            <i class="fa-solid fa-pen"></i>
            {{ __('edit') }}
          </a>

          <form action="{{ route('deleteService', $s->id_service) }}"
                method="POST"
                class="d-inline">
            @csrf
            <button class="btn btn-sm btn-danger"
              onclick="return confirm('{{ __('table.service.confirm') }}')">
              <i class="fa-solid fa-trash"></i>
              {{ __('hapus') }}
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="9" class="text-center text-muted">
          {{ __('table.service.kosong') }}
        </td>
      </tr>
    @endforelse
    </tbody>
  </table>

  <div class="mt-3">
    <a href="{{ route('service','id') }}">Indonesia</a> |
    <a href="{{ route('service','en') }}">English</a>
  </div>

</div>
@endsection
