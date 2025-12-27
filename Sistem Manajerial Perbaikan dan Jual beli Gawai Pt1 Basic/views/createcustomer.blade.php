@extends('master')
@section('title', __('table.customer.tambah'))

@section('content')
<div class="container mt-4 mb-4">

  <div class="card shadow-sm border-0">
    <div class="card-header bg-dark text-white">
      <h5 class="mb-0">
        <i class="bi bi-person-plus"></i>
        {{ __('table.customer.tambah') }}
      </h5>
    </div>

    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <strong>{{ __('form.error_title') }}</strong>
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('savecustomer') }}">
        @csrf
        <input type="hidden" name="locale" value="{{ $locale }}">

        <div class="mb-3">
          <label for="nama" class="form-label fw-semibold">
            {{ __('form.customer.nama') }}
          </label>
          <input type="text"
                 id="nama"
                 name="nama"
                 class="form-control @error('nama') is-invalid @enderror"
                 value="{{ old('nama') }}"
                 placeholder="{{ __('form.customer.nama') }}"
                 required>
          @error('nama')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="kontak" class="form-label fw-semibold">
            {{ __('form.customer.kontak') }}
          </label>
          <input type="text"
                 id="kontak"
                 name="kontak"
                 class="form-control @error('kontak') is-invalid @enderror"
                 value="{{ old('kontak') }}"
                 placeholder="{{ __('form.customer.kontak') }}"
                 required>
          @error('kontak')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="alamat" class="form-label fw-semibold">
            {{ __('form.customer.alamat') }}
          </label>
          <textarea id="alamat"
                    name="alamat"
                    class="form-control @error('alamat') is-invalid @enderror"
                    placeholder="{{ __('form.customer.alamat') }}"
                    required>{{ old('alamat') }}</textarea>
          @error('alamat')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
        <hr>

        <div class="d-flex justify-content-between align-items-center">
          <div>
            <button class="btn btn-success">
              <i class="bi bi-save"></i>
              {{ __('form.customer.simpan') }}
            </button>

            <button type="reset" class="btn btn-secondary">
              {{ __('form.customer.reset') }}
            </button>
          </div>

          <a href="{{ route('customer', $locale) }}" class="text-decoration-none">
            ← {{ __('form.back') }}
          </a>
        </div>

      </form>

    </div>
  </div>

  <div class="mt-3 text-end">
    <a href="{{ route('createcustomer','en') }}">English</a> |
    <a href="{{ route('createcustomer','id') }}">Indonesia</a>
  </div>

</div>
@endsection