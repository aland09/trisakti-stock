@php
    $title = 'Login Page';
    $description = 'Login Page';
@endphp
@extends('layouts.layout_full', ['title' => $title, 'description' => $description])
@section('css')
@endsection

{{--@section('js_vendor')
    <script src="/js/vendor/jquery.validate/jquery.validate.min.js"></script>
    <script src="/js/vendor/jquery.validate/additional-methods.min.js"></script>
@endsection

@section('js_page')
    <script src="/js/pages/auth.login.js"></script>
@endsection--}}

@section('content_left')
    <div class="min-h-100 d-flex align-items-center">
        <div class="w-100">
            <div>
                <div class="mb-5">
                    <h1 class="display-3 text-white">SISOMTER </h1>
                    <h1 class="display-3 text-white">Sistem Stock Management Trisakti </h1>
                </div>
                <p class="h6 text-white lh-1-5 mb-5">
                   
                </p>
                <div class="mb-5">
                    <a class="btn btn-lg btn-outline-white" href="/login">Telusuri</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content_right')
    <div
        class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
        <div class="sw-lg-50 px-5">
            <div class="d-flex flex-row gap-3 mb-3 align-items-center">
                <div class="sw-14">
                    <a href="/">
                        
                        {{--@if($admin->logo){
                            <img class="img-fluid h-100" src="{{$admin->logo}}" alt="logo" />
                        }--}}
                        <img class="img-fluid h-100" src="/img/logo/logo-alt.png" alt="logo" />
                        {{--@endif--}}
                    </a>
                </div>
                <div class="">
                    <h2 class="cta-4 mb-0 text-primary">Selamat Datang,</h2>
                    <h2 class="cta-4 text-primary">Dalam Sistem Stock Management Trisakti (SISOMTER)</h2>
                </div>
            </div>
            <div class="mb-5">
                <p class="h6">Harap masukan akun anda.</p>
                <!-- <p class="h6">
                    If you are not a member, please
                    <a href="/Pages/Authentication/Register">register</a>
                    .
                </p> -->
            </div>
            <div>
                <form id="loginForm" class="tooltip-end-bottom" novalidate action="/login" method="POST">
                    @csrf
                    <div class="mb-3 filled form-group tooltip-end-top">
                        <i data-acorn-icon="email"></i>
                        <input class="form-control" placeholder="Nama Pengguna" name="username" />
                    </div>
                    <div class="mb-3 filled form-group tooltip-end-top">
                        <i data-acorn-icon="lock-off"></i>
                        <input class="form-control pe-7" name="password" type="password" placeholder="Password" />
                        <!-- <a class="text-small position-absolute t-3 e-3"
                            href="/Pages/Authentication/ForgotPassword">Forgot?</a> -->
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary" type="button">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection
