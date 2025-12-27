@extends('master')
@section('title', __('master.service.tambah'))

@section('content')
<div class="container mt-4 mb-4">

  <div class="card shadow-sm border-0">
    <div class="card-header bg-dark text-white">
      <h5 class="mb-0">
        <i class="bi bi-plus-circle"></i>
        {{ __('Tambah Service') }}
      </h5>
    </div>

    <div class="card-body">

      <form method="POST" action="{{ route('masterService.store') }}">
        @csrf
        <input type="hidden" name="locale" value="{{ $locale }}">

        <div class="mb-3">
          <label class="form-label fw-semibold">
            {{ __('form.service.nama') }}
          </label>
          <input type="text"
                 name="nama_service"
                 class="form-control"
                 placeholder="{{ __('form.service.nama') }}"
                 required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">
            {{ __('form.service.harga') }}
          </label>
          <input type="number"
                 name="harga"
                 class="form-control"
                 placeholder="{{ __('form.service.harga') }}"
                 required>
        </div>

        <hr>
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <button class="btn btn-success">
              <i class="bi bi-save"></i>
              {{ __('form.simpan') }}
            </button>

            <a href="{{ route('masterService', $locale) }}"
               class="btn btn-secondary">
              {{ __('form.kembali') }}
            </a>
          </div>
        </div>

      </form>

    </div>
  </div>

  {{-- LANGUAGE SWITCH --}}
  <div class="mt-3 text-end">
    <a href="{{ route('masterService.create', 'en') }}">English</a> |
    <a href="{{ route('masterService.create', 'id') }}">Indonesia</a>
  </div>

</div>
@endsection