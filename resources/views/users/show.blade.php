@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mt-5 mb-4">
    <h3 class="fw-bold">Info Pengguna</h3>
</div>

<div class="card p-5 rounded-2 mb-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <!-- Form -->
            <div class="mb-3">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" value="{{ $user->name }}" disabled>
            </div>
        </div>
        <div class="col">
            <!-- Form -->
            <div class="mb-3">
                <label for="name">Email</label>
                <input type="text" class="form-control" id="name" value="{{ $user->email }}" disabled>
            </div>
        </div>
        <div class="col">
            <!-- Form -->
            <div class="mb-3">
                <label for="name">Nama Pengguna</label>
                <input type="text" class="form-control" id="name" value="{{ $user->username }}" disabled>
            </div>
        </div>
        <div class="col">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-secondary">Edit</a>
            <a href="{{ route('users.index') }}" class="btn btn-default">Kembali</a>
        </div>
    </div>
</div>
@endsection