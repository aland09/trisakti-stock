@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mt-5 mb-4">
    <h3 class="fw-bold">Edit Pengguna</h3>
</div>
        
<div class="card p-5 rounded-2 mb-5">
    <form method="post" action="{{ route('users.update', $user->id) }}" id="user-form">
        @method('PUT')
        @csrf
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col mb-3">
                <label for="name" class="form-label">Nama</label>
                <input value="{{ $user->name }}" 
                    type="text" 
                    class="form-control" 
                    name="name" 
                    placeholder="Nama" required>

                @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="col mb-3">
                <label for="email" class="form-label">Email</label>
                <input value="{{ $user->email }}"
                    type="email" 
                    class="form-control" 
                    name="email" 
                    placeholder="Email" required>
                @if ($errors->has('email'))
                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="col mb-3">
                <label for="username" class="form-label">Username</label>
                <input value="{{ $user->username }}"
                    type="text" 
                    class="form-control" 
                    name="username" 
                    placeholder="Username" required>
                @if ($errors->has('username'))
                    <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                @endif
            </div>
            <!-- <div class="col mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input value="{{ $user->nik }}"
                    type="number" 
                    class="form-control" 
                    name="nik" 
                    placeholder="NIK" required>
                @if ($errors->has('nik'))
                    <span class="text-danger text-left">{{ $errors->first('nik') }}</span>
                @endif
            </div> -->
            {{--<div class="col mb-3">
                <label class="my-1 me-2" for="skpd">SKPD Koordinator <span class="text-danger">*</span></label>
                <select class="form-select @error('skpd_id') is-invalid @enderror" id="skpd_id" aria-label="Default select example" name="skpd_id">
                    <option selected disabled>Pilih SKPD</option>
                    @foreach ($skpds as $skpd)
                        <option value="{{ $skpd->id }}" {{ $user->skpd_id == $skpd->id ? 'selected' : '' }} >{{ $skpd->name }}</option>
                    @endforeach
                </select>
                @error('skpd_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>--}}
            <div class="col mb-3">
                <label for="role" class="form-label">Peran</label>
                <select class="form-control" 
                    name="role" required>
                    <option value="">Pilih peran</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}"
                            {{ in_array($role->name, $userRole) 
                                ? 'selected'
                                : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('role'))
                    <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                @endif
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </form>
</div>

@endsection

@push('custom-js')
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {{--{!! JsValidator::formRequest('App\Http\Requests\UserRequest', '#user-form') !!}--}}
@endpush