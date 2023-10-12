@extends('layouts.app')
@push('custom-css')
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet" />
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" /> -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
@endpush
@section('content')


    <div class="mt-3">
        @include('layouts.partials.messages')
    </div>
    

    <div class="d-flex justify-content-between mt-5 mb-4">
        <h4>{{ $data['title'] }}</h4>
        @if ($data['controller'] == 'Category')
            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">Create</a>
        @elseif ($data['controller'] == 'Inventory')
        <!-- <a href="{{ route('inventories.create') }}" class="btn btn-primary btn-sm">Create</a> -->
                            
        <!-- Add New Button Start -->
                            </div>
                            <div class="d-flex justify-content-between mt-5 mb-4">
                            <button class="btn btn-primary btn-icon btn-icon-start  w-md-auto"
                                data-bs-toggle="dropdown" type="button" data-bs-offset="0,3">
                                <i data-acorn-icon="cloud-download"></i>
                                <span>Import Data</span>
                            </button>
                            <div class="dropdown-menu shadow dropdown-menu-end">
                                <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#modalImport">Import Excel</button>
                                <!--<button class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#modalTarikData">Tarik Data Monitoring</button>-->
                            </div>
                            {{--@dd($data['no_box_tmp'])--}}

                            {{-- <a href="{{ route('data-arsip.create') }}"
                                class="btn btn-primary btn-icon btn-icon-start w-100 w-md-auto mt-3 mt-sm-0">
                                <i data-acorn-icon="plus"></i>
                                <span>Tambah Data</span>
                            </a> --}}
                            <!-- Add New Button End -->
                            </div>                    
                            <div class="d-flex justify-content-between mt-5 mb-4">
                            <button type="button"
                                class="btn btn-primary btn-icon btn-icon-start w-md-auto"
                                id="btn-barcode">
                                <i data-acorn-icon="plus"></i>
                                <span>Buat QR Code No. Box</span>
                            </button>
                                <!-- Modal Import -->
    <div class="modal fade" id="modalImport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{route('inventories.import-barang-excel')}}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header py-3">
                        <h5 class="modal-title" id="exampleModalLabelDefault">Import Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        {{ csrf_field() }}
                        <div class="mb-3 position-relative form-group">
                            <label class="form-label text-primary fw-bold">File Import</label>
                            <input class="form-control" type="file" name="file" required="required" />
                            <span class="mb-3 position-relative">file dapat berupa csv, xls, maupun xlsx</span>
                        </div>
                    </div>
                    <div class="modal-footer pt-0 pb-4" style="border-top: none !important">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Import -->
    <div class="modal fade" id="modalFormBarcode" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{route('no-box-inventory')}}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header py-3">
                        <h5 class="modal-title" id="exampleModalLabelDefault">Buat QR Code No. Box</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex flex-column align-items-center justify-content-center text-center py-3">
                        {{ csrf_field() }}
                        {!! '<img class="mb-3" src="data:image/png;base64,' .
                            DNS2D::getBarcodePNG(url('/detail-barang', $data['no_box_tmp']), 'QRCODE', 12, 12) .
                            '" alt="' .
                            $data['no_box_tmp'] .
                            '"   />' !!}
                        <div class="form-label text-primary fw-bold" id="no_box_display">Mohon Tunggu...</div>
                        <input type="hidden" name="id[]" id="dokumen_id">
                        <!-- <input type="hidden" name="kurun_waktu" id="kurun_waktu"> -->

                    </div>
                    <div class="modal-footer pt-3 pb-3">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
            <a href="{{ route('inventories.create') }}" class="btn  btn-primary btn-sm">Create</a>
        @elseif ($data['controller'] == 'Room')
            <a href="{{ route('rooms.create') }}" class="btn btn-primary btn-sm">Create</a>
        @elseif ($data['controller'] == 'Transaction')
        <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm">Create</a>
        </div>
                            <!-- Date Filter -->
                <div style="margin: 20px 0px;">
                    <strong>Date Filter:</strong>
                    <input type="text" name="daterange" value="" />
                    <button class="btn btn-success filter">Filter</button>
                    <!-- <button class="btn btn-success clear">Clear Range Picker</button> -->
                </div>
        @endif
                         
    
    </div>

 
                        <!-- Datatables -->
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
        <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
        <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
        <script>
            $(document).ready(function() {
                var savedSelected; 
                var table = $('#datatables').DataTable({
                    processing: true,
                    serverSide: true,
                    select: true,
                    fixedHeader:true,
                    ajax: '{{ route('inventories.datatables') }}',
                    select: {
                                style: 'multi'},
                    columnDefs: [
                        {
                            targets: 0,
                            checkboxes: {
                            selectRow: true
                            }
                        }
                    ],
                    // columnDefs: [{
                    //     targets: 0,
                    //     searchable: false,
                    //     orderable: false,
                    //     width: '1%',
                    //     className: 'dt-body-center',
                    //     render: function (data, type, full, meta){
                    //         return '<input type="checkbox">';
                    //     }
                    // }],
                    columns: [
                        // {
                        //     title: '',
                        //     data: 'id',
                        //     name: 'id',
                        //     checkboxes: {
                        //         selectRow: true
                        //     },
                        //     className: 'text-wrap col-1',
                        //     render: function (data, type, full, meta){
                        //     return '<input type="checkbox">';
                        //     }
                        // },
                        {
                            title: ' ', 
                            data: 'id',
                            name: 'id',
                            visible: true,
                            className: 'text-wrap col-1',
                        },
                        {
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
                            title: 'No Box',
                            data: 'no_box',
                            name: 'no_box',
                            className: 'col-2',
                            orderable: false,
                            searchable: false,
                        },
                        {
                            title: 'Barcode',
                            data: 'Barcode',
                            name: 'barcode',
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
                    ],
                    
                
                    // buttons: [
                    //     {
                    //         extend: 'selected',
                    //         text: 'Count selected rows',
                    //         action: function ( e, dt, node, config ) {
                    //             var rows = dt.rows( { selected: true } ).count();
                
                    //             alert( 'There are '+rows+'(s) selected in the table' );
                    //         }
                    //     }
                    // ],
                });
                
                
                $('#btn-barcode').on('click',function(e){
                    // var form = this;
                    var form = this
                    // var val = $('.selectbox:checked').val();
                    // var val = $(rows_selected).val();
                    // $('.selectbox:checked').each(function(){
                        //     // id.push($(this).val()); 
                        //     alert('ada');
                    // });
                    // $.each(rows_selected,function(val){
                    //     alert(val);
                    // });
                    
                    var rows_selected = table.column(0).checkboxes.selected();
                    if(rows_selected.length > 0){
                        var ids = [];
                        $.each(rows_selected, function(e,id){
                        // const id = $(this).data('id')
                        // var data1 = $(data[1]).val();
                        // var data = table.row(this).data(); 
                        const idz = table.row(this).data().id;
                        var val = ids.push(id);
                        // alert(val);
                        $('#dokumen_id').val(id);
                        
                        // console.log('ada' + val);
                        $('#modalFormBarcode').modal('show');
                        $.ajax({
                                url: '/get-no-box',
                                type: "GET",
                                data: {
                                        "_token": "{{ csrf_token() }}"
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data) {
                                    $('#no_box_display').html(data);
                                    // $('#no_box').val(data);
                                } else {
                                    $('#no_box_display').html("Gagal Membuat QR Code");
                                    // $('#no_box').val('');
                                }
                            }
                        });
                    });
                    }else{
                        alert('tidak ada');
                    }
                    $('#dokumen_id').val(ids);
                        console.log('ids', ids);
                    // if(val)
                    // {
                    //     alert('berhasil');

                    // }else{
                    //     alert('pilih 1');
                    // }

                    
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
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script> -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script>
            
            $(document).ready(function() {
                // $('.date').daterangepicker('setDate', null);
                $('input[name="daterange"]').daterangepicker({
                    autoUpdateInput: true,
                    locale: {
                        cancelLabel: 'Clear'
                    }
                });
                
                var table = $('#datatables').DataTable({
                    processing: true,
                    serverSide: true,
                    dom: 'Bfrtip',
                    buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print','colvis'
                            ],
                    ajax: {
                        url:'{{ route('transactions.datatables') }}',
                        data:function (d) {
                            d.from_date = $('input[name="daterange"]').data('daterangepicker').startDate.format('YYYY-MM-DD');
                            d.to_date = $('input[name="daterange"]').data('daterangepicker').endDate.format('YYYY-MM-DD');
                            $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
                                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
                            });
                            $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                                $(this).val('');
                            });
                            }
                        },
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
                            data: 'inventory.name',
                            name: 'inventory.name',
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
                            title: 'Users',
                            data: 'user.name',
                            name: 'user.name',
                            className: 'text-wrap col-1',
                        },
                        {
                            title: 'action',
                            data: 'action',
                            orderable: false,
                            searchable: false,
                        }
                    ],
                    lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, 'All'] ], // #Display all records in server-side dataTable
                });

                $(".filter").click(function(){
                    table.draw();
                });
                
                
                // $(".clear").click(function(){
                //     var daterangepicker = $('input[name="daterange"]').data('daterangepicker');
                //     daterangepicker.daterangepicker({
                //         startDate: null,
                //         endDate: null,
                //     });
                // });
               
            });
           
        </script>
    @endif
@endpush

{{--@include('layouts.partials.delete-modal')--}}
