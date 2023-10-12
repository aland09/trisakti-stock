@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mt-5 mb-4">
    <h3 class="fw-bold">Info Peran</h3>
    <div class="">
        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-secondary">Edit</a>
    </div>
</div>
    
<div class="card border-0 shadow mb-4 mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-centered table-striped table-nowrap mb-0 rounded">
                <thead class="align-middle">
                    <th scope="col" class="col">Nama</th>
                    <th scope="col" class="col-1">Guard</th> 
                </thead>
                <tbody>
                    @foreach($rolePermissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection