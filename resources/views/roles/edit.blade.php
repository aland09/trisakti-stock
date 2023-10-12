@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mt-5 mb-4">
    <h3 class="fw-bold">Edit Peran</h3>
</div>

<div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Ups!</strong> Terdapat beberapa masalah.<br><br>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('roles.update', $role->id) }}">
        @method('patch')
        @csrf
        <div class="card p-5 rounded-2 mb-5">
            <div class="row row-cols-1 row-cols-md-1 g-4">
                <div class="col mb-5">
                    <label for="name" class="form-label">Nama</label>
                    <input value="{{ $role->name }}" 
                        type="text" 
                        class="form-control" 
                        name="name"
                        required>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <label class="form-label">Tetapkan hak akses</label>
                <a href="#bottom" class="btn btn-primary py-1 px-2 btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down mt-n1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                    </svg>
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-centered table-striped table-nowrap mb-0 rounded">
                    <thead class="align-middle">
                        <th scope="col" class="col-1 text-center"><input type="checkbox" name="all_permission"></th>
                        <th scope="col" class="col-10">Nama</th>
                        <th scope="col" class="col-1">Guard</th> 
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" 
                                    name="permission[{{ $permission->name }}]"
                                    value="{{ $permission->name }}"
                                    class='permission'
                                    {{ in_array($permission->name, $rolePermissions) 
                                        ? 'checked'
                                        : '' }}>
                                </td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->guard_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col mt-5" id="bottom">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </form>
</div>
@endsection

@push('custom-js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {

                if($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',false);
                    });
                }
                
            });
        });
    </script>
@endpush