@extends('master')
@section('title', __('table.barang.title'))

@section('content')

@if(Session::has('pesan'))
  <div class="alert alert-success">
    {{ Session::get('pesan') }}
  </div>
@endif

<div class="container mt-3">

  <h2>
    <i class="bi bi-phone"></i> {{ __('table.barang.title') }}
  </h2>


  <form method="GET" action="{{ url('/barang/'.app()->getLocale()) }}" class="mb-3">
    <div class="row">
      <div class="col-md-4">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               class="form-control"
               placeholder="{{ __('table.barang.search') }}">
      </div>
      <div class="col-md-4">
        <button class="btn btn-primary">
          🔍 {{ __('Search') }}
        </button>
        <a href="{{ url('/barang/'.app()->getLocale()) }}" class="btn btn-secondary">
          {{ __('Reset') }}
        </a>
      </div>
    </div>
  </form>

  <p>
    <a href="{{ route('createbarang', app()->getLocale()) }}">
      <button class="btn btn-success mb-2">
        {{ __('table.barang.tambah') }}
      </button>
    </a>
  </p>

  <table class="table table-hover shadow-sm rounded">
    <thead class="table-dark">
      <tr class="text-center">
        <th>{{ __('table.barang.nama') }}</th>
        <th>{{ __('table.barang.merek') }}</th>
        <th>{{ __('table.barang.ram') }}</th>
        <th>{{ __('table.barang.harga') }}</th>
        <th>{{ __('table.barang.stok') }}</th>
        <th>{{ __('table.barang.edit') }}</th>
        <th>{{ __('table.barang.hapus') }}</th>
      </tr>
    </thead>

    <tbody>
    @forelse ($data_barang as $b)
      <tr>
        <td>{{ $b->nama_barang }}</td>
        <td>{{ $b->merek }}</td>

        {{-- RAM--}}
        <td class="text-center">
          <select class="form-select form-select-sm" onchange="ubahHarga(this)">
            <option selected disabled>
              {{ __('table.barang.pilih_ram') }}
            </option>
            @foreach ($b->varian as $v)
              <option value="{{ $v->harga }}"
                      data-stok="{{ $v->stok }}">
                {{ $v->ram }}
              </option>
            @endforeach
          </select>
        </td>

        <td class="harga text-center">Rp 0</td>
        <td class="stok text-center">0</td>

        <td class="text-center">
          <a href="{{ route('editbarang', [$b->kd_barang, app()->getLocale()]) }}"
             class="btn btn-primary btn-sm">
            {{ __('table.barang.edit') }}
          </a>
        </td>

        <td class="text-center">
          <form action="{{ route('deletebarang', $b->kd_barang) }}" method="post">
            @csrf
            <button class="btn btn-danger btn-sm"
              onclick="return confirm('{{ __('table.barang.confirm') }}')">
              {{ __('table.barang.hapus') }}
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="7" class="text-center text-muted">
          {{ __('table.barang.kosong') }}
        </td>
      </tr>
    @endforelse
    </tbody>
  </table>

  <a href="/barang/en">English</a> |
  <a href="/barang/id">Indonesia</a>

</div>


<script>
function ubahHarga(select) {
  const harga = select.value;
  const stok  = select.options[select.selectedIndex].dataset.stok;
  const row   = select.closest('tr');

  row.querySelector('.harga').innerHTML =
    'Rp ' + Number(harga).toLocaleString('id-ID'); row.querySelector('.stok').innerHTML = stok;
}
</script>

@endsection
