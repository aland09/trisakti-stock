@extends('layouts.app')

@section('content')
    <div class="mt-3">
        @include('layouts.partials.messages')
    </div>

    <div class="d-flex justify-content-between mt-3 mb-4">
        @if ($data['type'] == 'Create')
            <h4>Create Category</h4>
        @elseif($data['type'] == 'Edit')
            <h4>Edit {{ $category->name }}</h4>
        @elseif($data['type'] == 'Show')
            <h4>Show {{ $category->name }}</h4>
        @endif
        <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
    </div>

    <div class="card mb-4 p-3">
        <div class="card-body">
            <form
                @if ($data['type'] == 'Create') action="{{ route('categories.store') }}" method="POST" @elseif($data['type'] == 'Edit') action="{{ route('categories.update', $category->id) }}" method="POST"@else action="" method="" @endif>

                @if ($data['type'] == 'Edit')
                    @method('PUT')
                @endif

                @csrf

                <div class="row row-cols-1 row-cols-md-1 g-4 mb-3">
                    <div class="col">
                        <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name"
                            @if ($category) value="{{ $category->name }}" @else value="{{ old('name') }}" @endif
                            autofocus>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-1 g-4 mb-3">
                    <div class="col">
                        <label for="description" class="form-label">Description</label>
                        @if ($category)
                            <textarea class="form-control @error('description') is-invalid @enderror" id="descriptionEditor" rows="3"
                                name="description">{{ $category->description }}</textarea>
                        @else
                            <textarea class="form-control @error('description') is-invalid @enderror" id="descriptionEditor" rows="3"
                                name="description">{{ old('description') }}</textarea>
                        @endif
                        @error('description')
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

@push('custom-js')
    <script>
        $(document).ready(function() {
            $(document).ready(function() {
                @if ($data['type'] == 'Show')
                    // $('.summernote').summernote({
                    //     tabsize: 2,
                    //     height: 80,
                    //     toolbar: false,
                    // });
                    // $('.summernote').summernote('disable')
                    $('input, select, textarea').prop('disabled', true);
                    $('#header').prop('disabled', false);
                @else
                    // $('.summernote').summernote({
                    //     tabsize: 2,
                    //     height: 80,
                    //     toolbar: false,
                    // });
                    $('input, select, textarea').prop('disabled', false);
                @endif
            });
        });
    </script>
@endpush
