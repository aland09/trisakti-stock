@extends('layouts.app-guest')

@section('content')
    <section class="d-flex align-content-center justify-content-center">
        <div class="container">
            <div class="">
                {{-- <div class="d-flex justify-content-between align-items-center">
                    <img src="{{ asset('assets/img/brand/light.png') }}" alt="" height="90">
                    
                </div> --}}
            </div>
            <div class="row align-items-end mt-10">
                <div class="col-12 col-lg-5 order-2 order-lg-1 text-center text-lg-left">
                    <h1 class="mt-5">Halo, selamat datang di Sister(Sistem Stock Terpadu)</h1>
                    <p class="lead my-4"><strong>Mari kita tingkatkan efisiensi melalui Sistem Stock Terpadu</strong> </p>
                     {{-- <a href="{{ route('preRegister') }}"
                        class="btn btn-gray-800 d-inline-flex align-items-center justify-content-center mb-4 me-3">Daftar
                        Sekarang</a>  --}}
                    <a href="{{ route('login') }}"
                        class="btn btn-secondary d-inline-flex align-items-center justify-content-center mb-4">Login</a>
                    

                </div>
                <div
                    class="col-12 col-lg-7 order-1 order-lg-2 text-center d-flex align-items-center justify-content-center">
                    <img class="img-fluid w-75" src="{{ asset('assets/img/brand/light.png') }}"
                        alt="500 Server Error">
                </div>
            </div>
            
        </div>
    </section>
@endsection

@push('custom-js')
   
@endpush
