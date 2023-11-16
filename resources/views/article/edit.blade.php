@extends('layouts.app')

@section('content')
    <h3>Edit Article</h3>
    <hr>
    <form id="articleUpdateForm" action="{{ route('article.update', $article->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
    </form>
        <div class="mb-3">
            <label class=" form-label" for="title">Article Title</label>
            <input type="text" class=" form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $article->title) }}" name="title" form="articleUpdateForm">
            @error('title')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class=" form-label" for="title">Select Category</label>
            <select  class=" form-select @error('category') is-invalid @enderror"
                 name="category" form="articleUpdateForm">
                 @foreach ($categories as $category)
                    <option value="{{$category->id}}"
                        {{old('category', $article->category_id) == $category->id ? 'selected' : ''}}
                        >{{$category->title}}</option>
                 @endforeach
            </select>
            @error('category')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <div class=" ">
                @isset($article->photos)
                    @foreach ($article->photos as $photo)
                        <div class=" d-inline-block position-relative me-2">
                            <img src="{{asset('storage/'. $photo->name)}}" height="100" class="rouned my-3" alt="">
                            <form class=" d-inline-block"  action="{{ route('photo.destroy', $photo->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm position-absolute top-0 end-0">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                @endisset
            </div>
            <div class="">
                <label class=" form-label" for="photos"> Article Photos</label>
                <input type="file" class=" form-control @error('photos') is-invalid @enderror @error('photos.*') is-invalid @enderror"
                     name="photos[]" multiple form="articleUpdateForm">
                @error('photos')
                    <div class=" invalid-feedback">{{ $message }}</div>
                @enderror
                @error('photos.*')
                    <div class=" invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class=" form-label" for="decription">Description</label>
            <textarea form="articleUpdateForm" name="description" id="decription" class=" form-control @error('description') is-invalid @enderror"
          cols="30" rows="10">{{ old('description', $article->description) }}</textarea>
            @error('description')
                <div class=" invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex mb-3">
            @isset($article->featured_image)
                <img height="100" class="rounded me-3" src="{{asset('storage/' . $article->featured_image)}}" alt="featured_image">
                <br>
            @endisset

            <div class="mb-3">
                <label class=" form-label" for="featured_image"> Featured image</label>
                <input type="file" class=" form-control @error('featured_image') is-invalid @enderror"
                    name="featured_image" form="articleUpdateForm">
                @error('featured_image')
                    <div class=" invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>


            <button type="submit" class=" btn btn-primary" form="articleUpdateForm">Update</button>

@endsection
