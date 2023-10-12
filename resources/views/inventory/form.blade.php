@extends('layouts.app')

@section('content')
    <div class="mt-3">
        @include('layouts.partials.messages')
    </div>

    <div class="d-flex justify-content-between mt-3 mb-4">
        @if ($data['type'] == 'Create')
            <h4>Create Inventory</h4>
        @elseif($data['type'] == 'Edit')
            <h4>Edit {{ $inventory->name }}</h4>
        @elseif($data['type'] == 'Show')
            <h4>Show {{ $inventory->name }}</h4>
        @elseif($data['type'] == 'Details')
            @if($inventory->count() > 0)
            
            <h4>Details {{ $no_box }}</h4>
            
            @endif
        @endif
        <a href="{{ route('inventories.index') }}" class="btn btn-primary">Back</a>
    </div>

    <div class="card border-0 shadow mb-4 p-3">
        <div class="card-body">
            @if($data['type'] != 'Details') 
                @if ($data['type'] != 'Create')
                    <div class="row row-cols-1 row-cols-md-2 g-4 mb-3">
                        <h5><strong>Image</strong></h5>
                        <div class="col">
                            @if($inventory->image)
                            <button class="btn btn-link border border-2 rounded p-1" data-bs-toggle="modal"
                                data-bs-target="#image{{ $inventory->id }}">
                                <img src="{{ asset('storage/' . $inventory->image) }}" alt="" width="150">
                            </button>
                            <div class="modal fade" id="image{{ $inventory->id }}" tabindex="-1"
                                aria-labelledby="image{{ $inventory->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <img src="{{ asset('storage/' . $inventory->image) }}" class="w-100">
                                </div>
                            </div>
                            @else
                            <div>
                            <h6><strong>Tidak ada</strong></h6>
                            </div>
                        </div>
                        @endif
                    </div>
                @endif
            <form
                @if ($data['type'] == 'Create') action="{{ route('inventories.store') }}" method="POST" @elseif($data['type'] == 'Edit') action="{{ route('inventories.update', $inventory->id) }}" method="POST"@else action="" method="" @endif
                enctype="multipart/form-data">

                @if ($data['type'] == 'Edit')
                    @method('PUT')
                @endif

                @csrf

                <div class="row row-cols-1 row-cols-md-3 g-4 mb-3">
                    <div class="col">
                        <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                        <input required type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name"
                            @if ($inventory) value="{{ $inventory->name }}" @else value="{{ old('name') }}" @endif
                            autofocus>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="category">Category<span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror"
                            aria-label="Default select example" name="category_id" required>
                            <option selected disabled>Choose Category</option>
                            @foreach ($categories as $category)
                                @if ($inventory)
                                    <option value="{{ $category->id }}"
                                        {{ $inventory->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="room">Room<span class="text-danger">*</span></label>
                        <select class="form-select @error('room_id') is-invalid @enderror"
                            aria-label="Default select example" name="room_id" required>
                            <option selected disabled>Choose Room</option>
                            @foreach ($rooms as $room)
                                @if ($inventory)
                                    <option value="{{ $room->id }}"
                                        {{ $inventory->room_id == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }}</option>
                                @else
                                    <option value="{{ $room->id }}"
                                        {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('room_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row row-cols-2 row-cols-md-4 g-4 mb-3">
                    <div class="col">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                            disabled
                            @if ($inventory) value="{{ $inventory->code }}" @else value="{{ old('code') }}" @endif>
                        @error('code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if ($data['type'] != 'Create')
                        <div class="col">
                            <label for="quantity" class="form-label">Quantity<span class="text-danger">*</span></label>
                            <input required type="number" class="form-control @error('quantity') is-invalid @enderror"
                                id="quantity" name="quantity"
                                @if ($inventory) value="{{ $inventory->quantity }}" @else value="{{ old('quantity') }}" @endif>
                            @error('quantity')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                    <div class="col">
                        <label for="satuan" class="form-label">Satuan<span class="text-danger">*</span></label>
                        <input required type="text" class="form-control @error('satuan') is-invalid @enderror"
                            id="satuan" name="satuan" placeholder="pcs, buah, rim, paket"
                            @if ($inventory) value="{{ $inventory->satuan }}" @else value="{{ old('satuan') }}" @endif>
                        @error('satuan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                        <input @if ($data['type'] == 'Create')  @endif
                            class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                            name="image">
                        <small>JPG,JPEG, PNG, max: 1024</small>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-1 g-4">
                    <div class="col">
                        <label for="description" class="form-label">Description</label>
                        @if ($inventory)
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="2"
                                name="description">{{ $inventory->description }}</textarea>
                        @else
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="2"
                                name="description">{{ old('description') }}</textarea>
                        @endif
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @if ($data['type'] != 'Show' and 'Details')
                    <button type="submit" class="btn btn-primary w-100 mt-5">Save</button>
                @endif
            </form>
            @else
            <!-- Mulai Details -->

                @foreach($inventory ?? [] as $invent)
                <div class="accordion">
                    <div class="accordion-item">
                                    <h2 class="accordion-header {{ $loop->first ? 'active' : '' }}" id="panelheading_{{$invent->id}}" >
                                        <button class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#panel_{{ $invent->id }}" type="button" aria-expanded="true" aria-controls="panel_{{ $invent->id }}">{{ $invent->name ? $invent->name : '-' }}</button></h2>
                                    <div  class="accordion-collapse collapse" id="panel_{{ $invent->id }}" aria-labelledby="panelheading_{{$invent->id}}">
                                        <div class="row row-cols-1 row-cols-md-2 g-4 mb-3">
                                            <div class="col accordion-body">
                                                <!-- image -->
                                                <h6><strong>Image</strong></h6>
                                                @if($invent->image)
                                                <button class="btn btn-link border border-2 rounded p-1" data-bs-toggle="modal"
                                                    data-bs-target="#image{{ $invent->id }}">
                                                    <img src="{{ asset('storage/' . $invent->image) }}" alt="-" width="150">
                                                </button>
                                                <div class="modal fade" id="image{{ $invent->id }}" tabindex="-1"
                                                    aria-labelledby="image{{ $invent->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <img src="{{ asset('storage/' . $invent->image) }}" class="w-100">
                                                    </div>
                                                </div>
                                                @else
                                                <div>
                                                <h6><strong>Tidak ada</strong></h6>
                                                </div>
                                                @endif
                                                <!-- image -->
                                                <div class="row row-cols-1 row-cols-md-3 g-4 mb-3">
                                                    <div class="col">
                                                        <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                                        <input required type="text" class="form-control @error('name') is-invalid @enderror"
                                                            id="name" name="name"
                                                            @if ($invent) value="{{ $invent->name }}" @else value="{{ old('name') }}" @endif
                                                            autofocus>
                                                        @error('name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label for="category">Category<span class="text-danger">*</span></label>
                                                        <select class="form-select @error('category_id') is-invalid @enderror"
                                                            aria-label="Default select example" name="category_id" required>
                                                            <option selected disabled>Choose Category</option>
                                                            @foreach ($categories as $category)
                                                                @if ($invent)
                                                                    <option value="{{ $category->id }}"
                                                                        {{ $invent->category_id == $category->id ? 'selected' : '' }}>
                                                                        {{ $category->name }}</option>
                                                                @else
                                                                    <option value="{{ $category->id }}"
                                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                                        {{ $category->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label for="room">Room<span class="text-danger">*</span></label>
                                                        <select class="form-select @error('room_id') is-invalid @enderror"
                                                            aria-label="Default select example" name="room_id" required>
                                                            <option selected disabled>Not Defined</option>
                                                            @foreach ($rooms as $room)
                                                                @if ($invent)
                                                                    <option value="{{ $room->id }}"
                                                                        {{ $invent->room_id == $room->id ? 'selected' : '' }}>
                                                                        {{ $room->name }}</option>
                                                                @else
                                                                    <option value="{{ $room->id }}"
                                                                        {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                                                        {{ $room->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('room_id')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                     <div class="col">
                                                        <label for="code" class="form-label">Code</label>
                                                        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                                                            disabled
                                                            @if ($invent) value="{{ $invent->code }}" @else value="{{ old('code') }}" @endif>
                                                        @error('code')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                            <label for="quantity" class="form-label">Quantity<span class="text-danger">*</span></label>
                                                            <input required type="number" class="form-control @error('quantity') is-invalid @enderror"
                                                                id="quantity" name="quantity"
                                                                @if ($invent) value="{{ $invent->quantity }}" @else value="{{ old('quantity') }}" @endif>
                                                            @error('quantity')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    
                                                    <div class="col">
                                                        <label for="satuan" class="form-label">Satuan<span class="text-danger">*</span></label>
                                                        <input required type="text" class="form-control @error('satuan') is-invalid @enderror"
                                                            id="satuan" name="satuan" placeholder="pcs, buah, rim, paket"
                                                            @if ($invent) value="{{ $invent->satuan }}" @else value="{{ old('satuan') }}" @endif>
                                                        @error('satuan')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row row-cols-1 row-cols-md-1 g-4">
                                                    <div class="col">
                                                        <label for="description" class="form-label">Description</label>
                                                        @if ($invent)
                                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="2"
                                                                name="description">{{ $invent->description }}</textarea>
                                                        @else
                                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="2"
                                                                name="description">{{ old('description') }}</textarea>
                                                        @endif
                                                        @error('description')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    </div>
                    <br>
                </div>
                <!-- <div class="row row-cols-1 row-cols-md-2 g-4 mb-3">
                        <div class="col">
                            <button class="btn btn-link border border-2 rounded p-1" data-bs-toggle="modal"
                                data-bs-target="#image{{ $invent->id }}">
                                <img src="{{ asset('storage/' . $invent->image) }}" alt="" width="150">
                            </button>
                            <div class="modal fade" id="image{{ $invent->id }}" tabindex="-1"
                                aria-labelledby="image{{ $invent->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <img src="{{ asset('storage/' . $invent->image) }}" class="w-100">
                                </div>
                            </div>
                        </div>
                    </div> -->
                @endforeach
            @endif
        </div>
    </div>
@endsection

{{-- @push('custom-js')
    <script>
        $(document).ready(function() {
            $('#name').val('Product1');
            $('#quantity').val(200);
            $('#satuan').val('pcs');
            $('#description').val('Deskripsi inventory');
        });
    </script>
@endpush --}}

@push('custom-js')
    <script>
        $(document).ready(function() {
            @if ($data['type'] == 'Show' || $data['type'] == 'Details' )
                $('input, select, textarea').prop('disabled', true);
                $('#header').prop('disabled', false);
            @else
                $('input, select, textarea').prop('required', true);
                $('input, select, textarea').prop('disabled', false);
                $('#code').prop('disabled', true);
                $('#image').prop('required', false);
            @endif
        });
    </script>
@endpush
