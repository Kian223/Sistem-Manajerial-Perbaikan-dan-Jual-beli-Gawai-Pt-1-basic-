@extends('master') 
@section('title', 'Data Peminjaman') 

@section('content')
<div class="container mt-3">
  <h2>Data Peminjaman</h2>
 
  <table class="table table-bordered table-striped">
    <thead class="table-success">
      <tr>
        <th style="text-align:center">Id</th>
		<th style="text-align:center">Tgl Pinjam</th>
        <th style="text-align:center">Id Anggota</th>
	    <th style="text-align:center">Id Buku</th>
		<th style="text-align:center">Lama Pinjam</th>
 	  </tr>
	</thead> 

    <tbody>
	@foreach ($data_peminjaman as $peminjaman)
      <tr>
	    <td style="text-align:center">{{$peminjaman->id}}</td>
		<td style="text-align:center">{{$peminjaman->tgl_pinjam}}</td>
        <td style="text-align:center">{{$peminjaman->id_anggota}}</td>		
		<td style="text-align:center">{{$peminjaman->id_buku}}</td>
		<td style="text-align:center">{{$peminjaman->lama_pinjam}}</td>		
      </tr>
	@endforeach  
	</tbody>
  </table>	 
</div>
@endsection

