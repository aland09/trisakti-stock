@extends('layouts.app')

@section('content')
    <div class="mt-3">
        @include('layouts.partials.messages')
    </div>

    <div class="d-flex justify-content-between mt-5 mb-4">
        <h4>{{ $data['title'] }}</h4>
        @if ($data['controller'] == 'Category')
            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">Create</a>
        @elseif ($data['controller'] == 'Inventory')
            <a href="{{ route('inventories.create') }}" class="btn btn-primary btn-sm">Create</a>
        @elseif ($data['controller'] == 'Room')
            <a href="{{ route('rooms.create') }}" class="btn btn-primary btn-sm">Create</a>
        @elseif ($data['controller'] == 'Transaction')
            <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm">Create</a>
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
                            title: 'Code',
                            data: 'code',
                            name: 'code',
                            className: 'text-wrap col-1',
                        },
                        {
                            title: 'Description',
                            data: 'description',
                            name: 'description',
                            className: 'text-wrap col-6',
                        },
                        {
                            title: 'action',
                            data: 'action',
                            orderable: false,
                            searchable: false,
                        }
                    ]
                });
            });
        </script>
    @elseif ($data['controller'] == 'Inventory')
        {{-- Inventory Index --}}
        <script>
            $(document).ready(function() {
                $('#datatables').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('inventories.datatables') }}',
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
                            title: 'Code',
                            data: 'code',
                            name: 'code',
                            className: 'text-wrap col-2',
                        },
                        {
                            title: 'Category',
                            data: 'category',
                            name: 'category',
                            className: 'text-wrap col-1',
                        },
                        {
                            title: 'Quantity',
                            data: 'quantity',
                            name: 'quantity',
                            className: 'text-wrap col-1',
                        },
                        {
                            title: 'Satuan',
                            data: 'satuan',
                            name: 'satuan',
                            className: 'text-wrap col-1',
                        },
                        {
                            title: 'Image',
                            data: 'image',
                            name: 'image',
                            className: 'col-2',
                            orderable: false,
                            searchable: false,
                        },
                        {
                            title: 'action',
                            data: 'action',
                            orderable: false,
                            searchable: false,
                        }
                    ]
                });
            });
        </script>
    @elseif ($data['controller'] == 'Room')
        {{-- Room Index --}}
        <script>
            $(document).ready(function() {
                $('#datatables').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('rooms.datatables') }}',
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
                            title: 'Code',
                            data: 'code',
                            name: 'code',
                            className: 'text-wrap col-1',
                        },
                        {
                            title: 'Description',
                            data: 'description',
                            name: 'description',
                            className: 'text-wrap col-6',
                        },
                        {
                            title: 'action',
                            data: 'action',
                            orderable: false,
                            searchable: false,
                        }
                    ]
                });
            });
        </script>
    @elseif ($data['controller'] == 'Transaction')
        {{-- Transaction Index --}}
        <script>
            $(document).ready(function() {
                $('#datatables').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('transactions.datatables') }}',
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
                            title: 'Date',
                            data: 'date',
                            name: 'date',
                            className: 'text-wrap col-2',
                        },
                        {
                            title: 'Inventory',
                            data: 'inventory_name',
                            name: 'inventory_name',
                            className: 'text-wrap col-3',
                        },
                        {
                            title: 'Status',
                            data: 'status',
                            name: 'status',
                            className: 'text-wrap col-1',
                        },
                        {
                            title: 'Quantity',
                            data: 'quantity',
                            name: 'quantity',
                            className: 'text-wrap col-1 text-center',
                        },
                        {
                            title: 'Stock',
                            data: 'stock',
                            name: 'stock',
                            className: 'text-wrap col-1',
                        },
                        {
                            title: 'action',
                            data: 'action',
                            orderable: false,
                            searchable: false,
                        }
                    ]
                });
            });
        </script>
    @endif
@endpush
