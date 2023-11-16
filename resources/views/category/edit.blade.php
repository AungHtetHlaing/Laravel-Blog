@extends('layouts.app')

@section('content')
    <h3>Edit Category</h3>
    <hr>
    <form action="{{ route('category.update', $category->id) }}" method="post">
        @csrf
        @method('put')
        <div class="mb-3">
            <label class=" form-label" for="title">Category Title</label>
            <input type="text" class=" form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $category->title) }}" name="title">
            @error('title')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


            <button type="submit" class=" btn btn-primary">Update</button>

    </form>
@endsection
