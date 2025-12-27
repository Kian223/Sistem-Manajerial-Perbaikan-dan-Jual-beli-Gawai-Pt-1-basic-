@extends('master')
@section('title', __('master.service.edit'))

@section('content')
<div class="container mt-4">

  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
      <h5 class="mb-0">
        <i class="bi bi-pencil-square"></i>
        {{ __('Ubah Data Jasa') }}
      </h5>
    </div>

    <div class="card-body">

      <form method="POST"
            action="{{ route('masterService.update', $master->id_master_service) }}">
        @csrf
        <input type="hidden" name="locale" value="{{ $locale }}">

        {{-- NAMA --}}
        <div class="mb-3">
          <label class="fw-semibold">
            {{ __('form.service.nama') }}
          </label>
          <input type="text"
                 name="nama_service"
                 class="form-control"
                 value="{{ $master->nama_service }}"
                 placeholder="{{ __('form.service.nama') }}"
                 required>
        </div>

        {{-- HARGA --}}
        <div class="mb-3">
          <label class="fw-semibold">
            {{ __('form.service.harga') }}
          </label>
          <input type="number"
                 name="harga"
                 class="form-control"
                 value="{{ $master->harga }}"
                 placeholder="{{ __('form.service.harga') }}"
                 required>
        </div>

        <hr>

        {{-- ACTION --}}
        <button class="btn btn-success">
          <i class="bi bi-save"></i>
          {{ __('form.update') }}
        </button>

        <a href="{{ route('masterService', $locale) }}"
           class="btn btn-secondary">
          {{ __('form.kembali') }}
        </a>

      </form>

    </div>
  </div>
</div>
@endsection