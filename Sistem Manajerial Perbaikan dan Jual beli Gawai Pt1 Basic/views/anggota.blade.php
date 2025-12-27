@extends('master') 
@section('title', 'Data Anggota') 

@section('content')
<div class="container mt-3">
  <h2>Data Anggota</h2>       
  
  <table class="table table-bordered table-striped">
    <thead class="table-success">
      <tr style="text-align:center">
        <td>Id</td>
        <td>IDNAma</td>
	    <td>Nama</td>
		<td>Kode Gender</td>
		<td>Alamat</td>
		</tr>
	</thead> 

    <tbody>
	@foreach ($data_anggota as $anggota)
      <tr>
	    <td style="text-align:center">{{$anggota->id}}</td>
        <td>{{$anggota->npm}}</td>		
        <td>{{$anggota->nama}}</td>   			  
		<td style="text-align:center">{{$anggota->kodegender}}</td>	
		<td>{{$anggota->alamat}}</td>		
      </tr>
	@endforeach  
	</tbody>
  </table>	 
</div>
@endsection

