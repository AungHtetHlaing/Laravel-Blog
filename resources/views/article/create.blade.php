@extends('layouts.app')

@section('content')
    <h3>Create New Article</h3>
    <hr>
    <form action="{{ route('article.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class=" form-label" for="title">Article Title</label>
            <input type="text" class=" form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}" name="title">
            @error('title')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class=" form-label" for="title">Select Category</label>
            <select  class=" form-select @error('category') is-invalid @enderror"
                 name="category">
                 @foreach ($categories as $category)
                    <option value="{{$category->id}}"
                        {{old('category') == $category->id ? 'selected' : ''}}
                        >{{$category->title}}</option>
                 @endforeach
            </select>
            @error('category')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class=" form-label" for="photos"> Article Photos</label>
            <input type="file" class=" form-control @error('photos') is-invalid @enderror @error('photos.*') is-invalid @enderror"
                 name="photos[]" multiple>
            @error('photos')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
            @error('photos.*')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class=" form-label" for="decription">Description</label>
            <textarea name="description" id="decription" class=" form-control @error('description') is-invalid @enderror"
             cols="30" rows="10">{{ old('description') }}</textarea>
            @error('description')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class=" form-label" for="featured_image"> Featured image</label>
            <input type="file" class=" form-control @error('featured_image') is-invalid @enderror"
                 name="featured_image">
            @error('featured_image')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

            <button type="submit" class=" btn btn-primary">Create   </button>

    </form>
@endsection
