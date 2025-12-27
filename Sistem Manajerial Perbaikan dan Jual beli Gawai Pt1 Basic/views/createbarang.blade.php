@extends('master')
@section('title', __('form.barang.title'))

@section('content')
<div class="container mt-4 mb-4">

  <div class="card shadow-sm border-0">
  <div class="card-header bg-dark text-white">
      <h5 class="mb-0">
        <i class="bi bi-plus-square"></i>
        {{ __('form.barang.title') }}
      </h5>
    </div>

    <div class="card-body">
      <form method="POST" action="{{ route('savebarang') }}">
        @csrf
        <input type="hidden" name="locale" value="{{ $locale }}">

        <div class="mb-3">
          <label class="form-label fw-semibold">
            {{ __('form.barang.nama') }}
          </label>
          <input type="text"
                 name="nama_barang"
                 class="form-control"
                 placeholder="{{ __('form.barang.nama') }}"
                 required>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">
            {{ __('form.barang.merek') }}
          </label>
          <input type="text"
                 name="merek"
                 class="form-control"
                 placeholder="{{ __('form.barang.merek') }}"
                 required>
        </div>
        <hr>
        <h6 class="fw-bold mb-3 text-secondary">
          <i class="bi bi-memory"></i>
          {{ __('Varian') }}
        </h6>

        {{-- VARIAN --}}
        <div id="varian-wrapper">

          <div class="row g-2 align-items-center varian-row mb-2">
            <div class="col-md-3">
              <input type="text"
                     name="ram[]"
                     class="form-control"
                     placeholder="RAM (8GB)"
                     required>
            </div>
            <div class="col-md-3">
              <input type="number"
                     name="harga[]"
                     class="form-control"
                     placeholder="{{ __('form.barang.harga') }}"
                     required>
            </div>
            <div class="col-md-3">
              <input type="number"
                     name="stok[]"
                     class="form-control"
                     placeholder="{{ __('form.barang.stok') }}"
                     required>
            </div>
            <div class="col-md-3">
              <button type="button"
                      class="btn btn-outline-danger w-100"
                      onclick="hapusVarian(this)">
                <i class="bi bi-trash"></i>
                {{ __('form.barang.hapus_varian') }}
              </button>
            </div>
          </div>

        </div>

        <button type="button"
                class="btn btn-outline-secondary btn-sm mb-3"
                onclick="tambahVarian()">
          <i class="bi bi-plus-circle"></i>
          {{ __('form.barang.tambah_varian') }}
        </button>

        <hr>

        <div class="d-flex justify-content-between align-items-center">
          <div>
            <button class="btn btn-success">
              <i class="bi bi-save"></i>
              {{ __('form.barang.simpan') }}
            </button>

            <button type="reset" class="btn btn-secondary">
              {{ __('form.barang.reset') }}
            </button>
          </div>

          <a href="{{ route('barang', $locale) }}" class="text-decoration-none">
            ← {{ __('form.back') }}
          </a>
        </div>

      </form>

    </div>
  </div>
  <div class="mt-3 text-end">
    <a href="{{ route('createbarang','en') }}">English</a> |
    <a href="{{ route('createbarang','id') }}">Indonesia</a>
  </div>

</div>

{{-- SCRIPT --}}
<script>
function tambahVarian() {
  let wrapper = document.getElementById('varian-wrapper');
  let row = wrapper.querySelector('.varian-row').cloneNode(true);
  row.querySelectorAll('input').forEach(input => input.value = '');
  wrapper.appendChild(row);
}

function hapusVarian(btn) {
  let wrapper = document.getElementById('varian-wrapper');
  if (wrapper.children.length > 1) {
    btn.closest('.varian-row').remove();
  } else {
    alert('{{ __("form.barang.minimal_varian") }}');
  }
}
</script>
@endsection
