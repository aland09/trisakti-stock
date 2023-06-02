@extends('layouts.app')

@section('content')
    <div class="mt-3">
        @include('layouts.partials.messages')
    </div>

    <div class="d-flex justify-content-between mt-5 mb-4">
        <h4>{{ $data['title'] }}</h4>
        @if ($data['controller'] == 'Category')
            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">Create</a>
        @endif
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
    @if ($data['controller'] == 'Category')
        {{-- Category Index --}}
        <script>
            $(document).ready(function() {
                $('#datatables').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('categories.datatables') }}',
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
                            title: 'Name',
                            data: 'name',
                            name: 'name',
                            className: 'text-wrap col-4',
                        },
                        {
                            title: 'Description',
                            data: 'description',
                            name: 'description',
                            className: 'text-wrap col-6',
                        },
                        {
                            title: 'Action',
                            data: 'Action',
                            orderable: false,
                            searchable: false,
                        }
                    ]
                });
            });
        </script>
    @endif
@endpush
