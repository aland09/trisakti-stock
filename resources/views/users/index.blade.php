@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mt-5 mb-4">
        <h4>Pengguna</h4>
        <div class="lead">
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Tambah pengguna</a>
        </div>
    </div>

    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <div class="card border-0 shadow mb-4 mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-striped table-nowrap mb-0 rounded" id="datatables">
                </table>
            </div>
        </div>
    </div>
@endsection


@push('custom-js')
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable({
                "initComplete": function() {
                    this.api().columns().header().to$().addClass('align-middle text-wrap');
                },
                processing: true,
                serverSide: true,
                ajax: '{{ route('users.datatables') }}',
                columns: [{
                        title: 'No',
                        data: '',
                        name: '',
                        className: 'text-wrap col-1',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        title: 'Nama',
                        data: 'name',
                        name: 'name',
                        className: 'text-wrap col-4',
                    },
                    {
                        title: 'Username',
                        data: 'username',
                        name: 'username',
                        className: 'text-wrap col-4',
                    },
                    {
                        title: 'Email',
                        data: 'email',
                        name: 'email',
                        className: 'text-wrap col-2',
                    },
                    {
                        title: 'Aksi',
                        data: 'Aksi',
                        orderable: false,
                        searchable: false,
                    }
                ]
            });
        });
    </script>
@endpush

{{--@include('layouts.partials.delete-modal')--}}
