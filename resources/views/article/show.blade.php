@extends('layouts.app')

@section('content')
    <a href="{{ route('article.index') }}" class=" btn btn-outline-primary">All Articles</a>
    <hr>

    <h4>{{ $article->title }}</h4>
    <hr>

    <div class="">
        <span class="badge bg-secondary">
            <i class=" bi bi-grid"></i>
            {{$article->category->title}}
        </span>
        <span class="badge bg-secondary">
            <i class=" bi bi-person"></i>
            {{$article->user->name}}
        </span>
        <span class="badge bg-secondary">
            <i class=" bi bi-clock"></i>
            {{$article->created_at->format("h:i a")}}
        </span>
        <span class="badge bg-secondary">
            <i class=" bi bi-calendar"></i>
            {{$article->created_at->format("d M Y")}}
        </span>
    </div>

    @isset($article->featured_image)
        <img src="{{asset('storage/'. $article->featured_image)}}" height="100" class="rounded my-3" alt="">
    @endisset

    <div class="" style="white-space: pre-wrap">
        {{ $article->description }}
    </div>

    @isset($article->photos)
        @foreach ($article->photos as $photo)
            <img src="{{asset('storage/'. $photo->name)}}" height="100" class="rouned my-3" alt="">

        @endforeach
    @endisset

@endsection
