
@extends('layouts.app')


@section('header')
  @include('partials.header')
@endsection

@section('about')
@include('partials.about')
@endsection

@section('content')
<div class="container">
    <div class="text-center">
        <h2 class="section-heading text-uppercase">use</h2>
        <h3 class="section-subheading text-muted">Untuk Memulai silakan ikuti panduan dibawah</h3>
    </div>
    <div class="row text-center">
        <div class="col-md-4">
            <span class="fa-stack fa-4x">
                <i class="fa-solid fa-circle-notch"></i>
            </span>
            <h4 class="my-3">Login</h4>
            <p class="text-muted">
                Fitur login dalam aplikasi prediksi 
                kami merupakan langkah awal yang penting untuk mengakses berbagai 
                fitur prediksi berbasis Naive Bayes. </p>
        </div>
        <div class="col-md-4">
            <span class="fa-stack fa-4x">
                <i class="fa-solid fa-chart-simple"></i>
            </span>
            <h4 class="my-3">Lakukan Prediksi</h4>
            <p class="text-muted">Untuk memulai proses prediksi dengan aplikasi kami, pengguna perlu mengikuti beberapa langkah sederhana yang mencakup memasukkan informasi pribadi, seperti nama dan NPM (Nomor Pokok Mahasiswa), 
                serta data akademik berupa nilai IPS (Indeks Prestasi Semester) dari semester 1 hingga semester 5.</p>
        </div>
        <div class="col-md-4">
            <span class="fa-stack fa-4x">
                <i class="fa-brands fa-think-peaks"></i>
            </span>
            <h4 class="my-3">Hail Prediksi</h4>
            <p class="text-muted">pengguna dalam menginterpretasikan dan memahami hasil analisis prediksi yang dilakukan menggunakan algoritma Naive Bayes. Setelah proses prediksi selesai, pengguna akan melihat hasil prediksi yang disajikan dengan cara yang jelas dan informatif di antarmuka aplikasi.</p>
        </div>
        
    </div>
</div>

@endsection
