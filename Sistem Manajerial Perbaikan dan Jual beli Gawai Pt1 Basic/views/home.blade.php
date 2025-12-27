@extends('master')
@section('title', 'Home')

@section('content')

<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">PROFIL APLIKASI</h2>
        <p class="text-muted">Informasi dasar mengenai sistem yang digunakan</p>
    </div>
    <div class="d-flex justify-content-center">
        <div class="card shadow-lg border-0" style="width: 40rem;">
            <div class="card-body">
                
                <table class="table table-bordered table-striped text-center mb-0">
                    <tr class="table-dark">
                        <th colspan="2">Informasi Aplikasi</th>
                    </tr>

                    <tr>
                        <th class="w-50">Nama Aplikasi</th>
                        <td>Sistem Informasi Penjualan dan Perbaikan HP</td>
                    </tr>

                    <tr>
                        <th>Nama Mahasiswa</th>
                        <td>Deffa Kiane Basyar</td>
                    </tr>

                    <tr>
                        <th>NPM</th>
                        <td>2023130015</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>

</div>

@endsection
