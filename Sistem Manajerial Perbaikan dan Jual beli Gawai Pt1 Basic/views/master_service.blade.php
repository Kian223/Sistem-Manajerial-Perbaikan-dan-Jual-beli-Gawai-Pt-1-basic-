@extends('master')
@section('title', __('table.master_service.title'))

@section('content')

@if(Session::has('pesan'))
  <div class="alert alert-success">
    {{ Session::get('pesan') }}
  </div>
@endif

<div class="container mt-3">

  <h2>
    <i class="bi bi-tools"></i>
    {{ __('table.master_service.title') }}
  </h2>

  {{-- 🔍 SEARCH --}}
  <form method="GET"
        action="{{ url('/master-service/'.app()->getLocale()) }}"
        class="mb-3">
    <div class="row">
      <div class="col-md-4">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               class="form-control"
               placeholder="{{ __('table.master_service.search') }}">
      </div>
      <div class="col-md-4">
        <button class="btn btn-primary">
          🔍 {{ __('Search') }}
        </button>
        <a href="{{ url('/master-service/'.app()->getLocale()) }}"
           class="btn btn-secondary">
          {{ __('Reset') }}
        </a>
      </div>
    </div>
  </form>


  <p>
    <a href="{{ route('masterService.create', app()->getLocale()) }}">
      <button class="btn btn-success mb-2">
        {{ __('table.master_service.tambah') }}
      </button>
    </a>
  </p>
  <table class="table table-hover shadow-sm rounded">
    <thead class="table-dark">
      <tr class="text-center">
        <th>No</th>
        <th>{{ __('table.master_service.nama') }}</th>
        <th>{{ __('table.master_service.harga') }}</th>
        <th>{{ __('table.master_service.edit') }}</th>
        <th>{{ __('table.master_service.hapus') }}</th>
      </tr>
    </thead>

    <tbody>
    @forelse ($data as $m)
      <tr>
        <td class="text-center">{{ $loop->iteration }}</td>

        <td>{{ $m->nama_service }}</td>

        <td class="text-end">
          Rp {{ number_format($m->harga,0,',','.') }}
        </td>

        <td class="text-center">
          <a href="{{ route('masterService.edit', [$m->id_master_service, app()->getLocale()]) }}"
             class="btn btn-primary btn-sm">
            {{ __('table.master_service.edit') }}
          </a>
        </td>

        <td class="text-center">
          <form action="{{ route('masterService.delete', $m->id_master_service) }}"
                method="POST">
            @csrf
            <button class="btn btn-danger btn-sm"
              onclick="return confirm('{{ __('table.master_service.confirm') }}')">
              {{ __('table.master_service.hapus') }}
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="5" class="text-center text-muted">
          {{ __('table.master_service.kosong') }}
        </td>
      </tr>
    @endforelse
    </tbody>
  </table>

  <a href="/master-service/en">English</a> |
  <a href="/master-service/id">Indonesia</a>

</div>
@endsection
