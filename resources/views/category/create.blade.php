@extends('layouts.app')

@section('content')
    <h3>Create New Category</h3>
    <hr>
    <form action="{{ route('category.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label class=" form-label" for="title">Category Title</label>
            <input type="text" class=" form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}" name="title">
            @error('title')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


            <button type="submit" class=" btn btn-primary">Create   </button>

    </form>
@endsection
