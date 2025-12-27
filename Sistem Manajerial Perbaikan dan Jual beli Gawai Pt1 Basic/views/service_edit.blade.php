@extends('master')
@section('title', 'Edit Service')

@section('content')
<div class="container mt-4 mb-4">

  <div class="card shadow-sm border-0">
    <div class="card-header bg-dark text-white">
      <h5 class="mb-0">
        <i class="bi bi-pencil-square"></i>
        Edit Service
      </h5>
    </div>

    <div class="card-body">

      <form method="POST"
            action="{{ route('updateService', $service->id_service) }}">
        @csrf
        <input type="hidden" name="locale" value="{{ $locale }}">

        <div class="mb-3">
          <label class="form-label fw-semibold">Customer</label>
          <input type="text"
                 class="form-control"
                 value="{{ $service->customer->nama }}"
                 readonly>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Jenis Service</label>
          <input type="text"
                 class="form-control"
                 value="{{ $service->masterService->nama_service }}"
                 readonly>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">IMEI</label>
          <input type="text"
                 class="form-control"
                 value="{{ $service->imei }}"
                 readonly>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Tanggal Masuk</label>
          <input type="date"
                 class="form-control"
                 value="{{ $service->tanggal_masuk }}"
                 readonly>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Garansi Sampai</label>
          <input type="date"
                 name="garansi_sampai"
                 class="form-control"
                 value="{{ $service->garansi_sampai }}">
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Status</label>
          <select name="status" class="form-control" required>
            @foreach(['Masuk','Proses','Selesai','Diambil'] as $status)
              <option value="{{ $status }}"
                {{ $service->status == $status ? 'selected' : '' }}>
                {{ $status }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Total Biaya</label>
          <input type="text"
                 class="form-control"
                 value="Rp {{ number_format($service->total_biaya,0,',','.') }}"
                 readonly>
        </div>

        <hr>

        <div class="d-flex justify-content-between">
          <button class="btn btn-success">
            <i class="bi bi-save"></i> Update
          </button>

          <a href="{{ route('service', $locale) }}" class="btn btn-secondary">
            Kembali
          </a>
        </div>

      </form>

    </div>
  </div>

  <div class="mt-3 text-end">
    <a href="{{ route('editService', [$service->id_service, 'en']) }}">English</a> |
    <a href="{{ route('editService', [$service->id_service, 'id']) }}">Indonesia</a>
  </div>

</div>
@endsection