@extends('master')
@section('title', 'Top Customer')

@section('content')
<div class="container mt-4">

<div class="card shadow-sm border-0">
<div class="card-header bg-dark text-white">
  <h5 class="mb-0">
    <i class="bi bi-people"></i> Top Customer
  </h5>
</div>

<div class="card-body">

<table class="table table-bordered table-hover">
<thead class="table-dark text-center">
<tr>
  <th>No</th>
  <th>Customer</th>
  <th>Total Transaksi</th>
  <th>Total Belanja</th>
</tr>
</thead>

<tbody>
@forelse($data as $row)
<tr>
  <td class="text-center">{{ $loop->iteration }}</td>
  <td>{{ optional($row->customer)->nama }}</td>
  <td class="text-center">{{ $row->jumlah_transaksi }}</td>
  <td class="text-end">
    Rp {{ number_format($row->total_belanja,0,',','.') }}
  </td>
</tr>
@empty
<tr>
  <td colspan="4" class="text-center text-muted">
    Data belum ada
  </td>
</tr>
@endforelse
</tbody>
</table>

</div>
</div>

</div>
@endsection
