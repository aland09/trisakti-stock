@extends('layouts.app')

@section('content')
    <div class="mt-3">
        @include('layouts.partials.messages')
    </div>

    <div class="d-flex justify-content-between mt-3 mb-4">
        @if ($data['type'] == 'Create')
            <h4>{{ $data['title'] }}</h4>
        @elseif($data['type'] == 'Edit')
            <h4>Edit {{ $transaction->name }}</h4>
        @elseif($data['type'] == 'Show')
            <h4>Show {{ $transaction->name }}</h4>
        @endif
        <a href="{{ route('transactions.index') }}" class="btn btn-primary">Back</a>
    </div>

    <div class="card mb-4 p-3">
        <div class="card-body">
            <form
                @if ($data['type'] == 'Create') action="{{ route('transactions.store') }}" method="POST" @elseif($data['type'] == 'Edit') action="{{ route('transactions.update', $transaction->id) }}" method="POST"@else action="" method="" @endif>

                @if ($data['type'] == 'Edit')
                    @method('PUT')
                @endif

                @csrf
                
                <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
                    <div class="col">
                        <input type="hidden" value="{{$user_id}}" name="user_id">

                        <label for="date" class="form-label">Date<span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                            name="date"
                            @if ($transaction) value="{{ $transaction->date }}" @else value="{{ old('date') }}" @endif
                            autofocus>
                        @error('date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="Inventory">Inventory<span class="text-danger">*</span></label>
                        <select class="form-select select2 @error('inventory_id') is-invalid @enderror"
                            aria-label="Default select example" name="inventory_id" required>
                            <option></option>
                            @foreach ($inventories as $inventory)
                                @if ($transaction)
                                    <option value="{{ $inventory->id }}"
                                        {{ $transaction->inventory_id == $inventory->id ? 'selected' : '' }}
                                        data-image="{{ $inventory->image }}">
                                        {{ $inventory->name }}
                                    </option>
                                @else
                                    <option value="{{ $inventory->id }}"
                                        {{ old('inventory_id') == $inventory->id ? 'selected' : '' }}
                                        data-image="{{ $inventory->image }}">
                                        {{ $inventory->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('inventory_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="quantity" class="form-label">Quantity<span class="text-danger">*</span></label>
                        <input required type="number" class="form-control @error('quantity') is-invalid @enderror"
                            id="quantity" name="quantity"
                            @if ($transaction) value="{{ $transaction->quantity }}" @else value="{{ old('quantity') }}" @endif>
                        @error('quantity')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                
                <div class="row row-cols-1 row-cols-md-2 g-4 mb-3">
                    <div class="col">
                        <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
                        <div class="btn-group w-100" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="status" id="masuk" autocomplete="off"
                                value="masuk"
                                @if ($transaction && $transaction->status == 'masuk') checked
                                @elseif (!$transaction && old('status') == 'masuk')
                                checked @endif>
                            <label class="btn btn-outline-success" for="masuk">Barang Masuk</label>

                            <input type="radio" class="btn-check" name="status" id="pinjam" autocomplete="off"
                                value="pinjam"
                                @if ($transaction && $transaction->status == 'pinjam') checked
                                @elseif (!$transaction && old('status') == 'pinjam')
                                checked @endif>
                            <label class="btn btn-outline-primary" for="pinjam">Dipinjamkan</label>

                            <input type="radio" class="btn-check" name="status" id="keluar" autocomplete="off"
                                value="keluar"
                                @if ($transaction && $transaction->status == 'keluar') checked
                                @elseif (!$transaction && old('status') == 'keluar')
                                checked @endif>
                            <label class="btn btn-outline-danger" for="keluar">Barang Keluar</label>
                        </div>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="uuid" class="form-label">Transaction Code<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('uuid') is-invalid @enderror" id="uuid"
                            name="uuid"
                            @if ($transaction) value="{{ $transaction->uuid }}" @else value="{{ old('uuid') }}" @endif
                            autofocus>
                        @error('uuid')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-1 g-4 mb-3">
                    <div class="col">
                        <label for="notes" class="form-label">Notes</label>
                        @if ($transaction)
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" rows="2" name="notes">{{ $transaction->notes }}</textarea>
                        @else
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" rows="2" name="notes">{{ old('notes') }}</textarea>
                        @endif
                        @error('notes')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @if ($data['type'] != 'Show')
                    <button type="submit" class="btn btn-primary w-100 mt-5">Save</button>
                @endif
            </form>
        </div>
    </div>
@endsection

@push('custom-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            min-height: 37px;
            display: flex;
            align-items: center;
        }
    </style>
@endpush

@push('custom-js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        function formatState(state) {
            if (!state.id) {
                return state.text;
            }
            var image = $(state.element).data('image');
            var path = `{{ asset('storage/${image}') }}`;
            var $state = $(
                '<span><img src="' + path + '" width="50" class="me-2 shadow border border-1" /> ' +
                state.text + '</span>'
            );
            return $state;
        }

        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select Inventory",
                templateResult: formatState,
            });
        });

        $(document).ready(function() {
            @if ($data['type'] == 'Show')
                $('input, select, textarea').prop('disabled', true);
                $('#header').prop('disabled', false);
            @else
                // $('input, select, textarea').prop('required', true);
                $('input, select, textarea').prop('disabled', false);
                $('#notes').prop('required', false);
                $('#uuid').prop('disabled', true);
            @endif
        });
    </script>
@endpush
