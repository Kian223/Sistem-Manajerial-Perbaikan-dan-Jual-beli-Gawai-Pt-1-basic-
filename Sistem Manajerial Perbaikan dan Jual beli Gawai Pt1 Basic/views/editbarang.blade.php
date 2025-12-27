@extends('master')
@section('title', __('ubah.barang.title'))

@section('content')
<div class="container mt-4 mb-4">

  <div class="card shadow-sm border-0">
    <div class="card-header bg-dark text-white">
      <h5 class="mb-0">
        <i class="bi bi-pencil-square"></i>
        {{ __('ubah.barang.title') }}
      </h5>
    </div>
    <div class="card-body">
      <form method="POST"
            action="{{ route('updatebarang', $barang->kd_barang) }}">
        @csrf
        <input type="hidden" name="locale" value="{{ $locale }}">
        <div class="mb-3">
          <label class="form-label fw-semibold">
            {{ __('ubah.barang.nama') }}
          </label>
          <input type="text"
                 name="nama_barang"
                 class="form-control"
                 value="{{ $barang->nama_barang }}"
                 required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">
            {{ __('ubah.barang.merek') }}
          </label>
          <input type="text"
                 name="merek"
                 class="form-control"
                 value="{{ $barang->merek }}"
                 required>
        </div>
        <hr>
        <h6 class="fw-bold mb-3">
          <i class="bi bi-memory"></i>
          {{ __('Varian') }}
        </h6>

        {{-- VARIAN --}}
        <div id="varian-wrapper">
          @foreach ($barang->varian as $v)
          <div class="row g-2 align-items-center varian-row mb-2">
            <input type="hidden" name="id_varian[]" value="{{ $v->id_varian }}">

            <div class="col-md-3">
              <input type="text"
                     name="ram[]"
                     class="form-control"
                     value="{{ $v->ram }}"
                     required>
            </div>

            <div class="col-md-3">
              <input type="number"
                     name="harga[]"
                     class="form-control"
                     value="{{ $v->harga }}"
                     required>
            </div>

            <div class="col-md-3">
              <input type="number"
                     name="stok[]"
                     class="form-control"
                     value="{{ $v->stok }}"
                     required>
            </div>

            <div class="col-md-3">
              <button type="button"
                      class="btn btn-outline-danger w-100"
                      onclick="hapusVarian(this)">
                <i class="bi bi-trash"></i>
                {{ __('ubah.barang.hapus_varian') }}
              </button>
            </div>

          </div>
          @endforeach

        </div>

        <button type="button"
                class="btn btn-outline-secondary btn-sm mb-3"
                onclick="tambahVarian()">
          <i class="bi bi-plus-circle"></i>
          {{ __('ubah.barang.tambah_varian') }}
        </button>
        <hr>
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <button class="btn btn-success">
              <i class="bi bi-save"></i>
              {{ __('ubah.barang.update') }}
            </button>

            <a href="{{ route('barang', $locale) }}"
               class="btn btn-secondary">
              {{ __('ubah.barang.kembali') }}
            </a>
          </div>
        </div>

      </form>

    </div>
  </div>
  <div class="mt-3 text-end">
    <a href="{{ route('editbarang', [$barang->kd_barang, 'en']) }}">English</a> |
    <a href="{{ route('editbarang', [$barang->kd_barang, 'id']) }}">Indonesia</a>
  </div>

</div>

<script>
function tambahVarian() {
  let wrapper = document.getElementById('varian-wrapper');
  let row = wrapper.querySelector('.varian-row').cloneNode(true);

  row.querySelectorAll('input').forEach(input => {
    if (input.type !== 'hidden') input.value = '';
  });

  wrapper.appendChild(row);
}

function hapusVarian(btn) {
  let wrapper = document.getElementById('varian-wrapper');

  if (wrapper.children.length > 1) {
    btn.closest('.varian-row').remove();
  } else {
    alert('{{ __("ubah.barang.minimal_varian") }}');
  }
}
</script>
@endsection
