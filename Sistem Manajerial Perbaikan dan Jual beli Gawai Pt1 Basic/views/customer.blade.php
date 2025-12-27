@extends('master')
@section('title', __('table.customer.title'))

@section('content')
@if(Session::has('pesan'))
   <div class="alert alert-success">{{ Session::get('pesan') }}</div>
@endif 

<div class="container mt-3"> 
  <h2> <i class="bi bi-people-fill"></i> {{ __('table.customer.title') }}</h2>


  <form method="GET" action="{{ url('/customer/'.app()->getLocale()) }}" class="mb-3">
    <div class="row">
      <div class="col-md-4">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               class="form-control"
               placeholder="{{ __('Searching') }}">
      </div>
      <div class="col-md-3">
        <button class="btn btn-primary">
          🔍 {{ __('Search') }}
        </button>
        <a href="{{ url('/customer/'.app()->getLocale()) }}" class="btn btn-secondary">
          {{ __('Reset') }}
        </a>
      </div>
    </div>
  </form>

  <p>
    <a href="/customer/create/{{ app()->getLocale() }}">
      <button class="btn btn-success mb-2">
        {{ __('table.customer.tambah') }}
      </button>
    </a>
  </p>  

  <table class="table table-hover shadow-sm rounded">
    <thead class="table-dark">
      <tr style="text-align:center">
        <th>{{ __('table.customer.id') }}</th>
        <th>{{ __('table.customer.kode') }}</th>
        <th>{{ __('table.customer.nama') }}</th>
        <th>{{ __('table.customer.kontak') }}</th>
        <th>{{ __('table.customer.alamat') }}</th>
        <th>{{ __('table.customer.edit') }}</th>
        <th>{{ __('table.customer.hapus') }}</th>
      </tr>
    </thead> 

    <tbody>
    @forelse ($data_customer as $c)
      <tr>
        <td style="text-align:center">{{ $c->id_customer }}</td>
        <td style="text-align:center">{{ $c->kode_customer ?? '-' }}</td>
        <td>{{ $c->nama }}</td>
        <td>{{ $c->kontak }}</td>			  
        <td>{{ $c->alamat }}</td>

        <td style="text-align:center">
          <a href="{{ route('editcustomer', [$c->id_customer, app()->getLocale()]) }}">
            <button class="btn btn-primary btn-sm">
              {{ __('table.customer.edit') }}
            </button>
          </a>
        </td>

        <td style="text-align:center">
          <form action="{{ route('deletecustomer', $c->id_customer) }}" method="post">
            @csrf
            <button class="btn btn-danger btn-sm" 
              onclick="return confirm('{{ __('table.customer.confirm') }}')">
              {{ __('table.customer.hapus') }}
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="7" class="text-center text-muted">
          {{ __('table.customer.kosong') }}
        </td>
      </tr>
    @endforelse  
    </tbody>
  </table>

  <a href="/customer/en">English</a> |
  <a href="/customer/id">Indonesia</a>
</div>  
@endsection
