@extends('master') 
@section('title', 'Tambah Buku') 

@section('content')
<div class="container mb-3 mt-3">
  <h2>Tambah Data Buku</h2>  
  <form method="post" action="/savebuku">
     @csrf
	  <div class="mb-3 mt-3">
		<label for="judul" class="form-label">Judul Buku :</label>
		<input type="text" class="form-control" id="judul" name="judul">
	  </div>  
	  <div class="mb-3 mt-3">
		<label for="penulis" class="form-label">Penulis :</label>
		<input type="text" class="form-control" id="penulis" name="penulis">
	  </div>  
	  <div class="mb-3 mt-3">
		<label for="penerbit" class="form-label">Penerbit :</label>
		<input type="text" class="form-control" id="Penerbit" name="penerbit">
	  </div>  
	  <div class="mb-3 mt-3">
		<label for="radio1" class="form-label">Kategori :</label>
        <div class="form-check">
			<input type="radio" class="form-check-input" id="radio1" name="kodekat" value="S" checked>
			<label class="form-check-label" for="radio1">Sains</label>
		</div>
		<div class="form-check">
			<input type="radio" class="form-check-input" id="radio2" name="kodekat" value="F">
			<label class="form-check-label" for="radio2">Fiksi</label>
		</div>
	  </div>
 	  <div class="mb-3 mt-3">
		<label for="harga" class="form-label">Harga Buku:</label>
		<input type="text" class="form-control" id="judul" name="harga">
	  </div>  	  
      <div class="mb-3 mt-3">
	    <button class="btn btn-success mb-2" type="submit">Simpan</button>
        <button class="btn btn-success mb-2" type="reset">Batal</button>
      </div>
  </form>
</div>
@endsection

