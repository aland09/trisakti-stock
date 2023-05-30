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
                <table class="table table-centered table-striped table-nowrap mb-0 rounded">
                </table>
            </div>
        </div>
    </div>
@endsection
