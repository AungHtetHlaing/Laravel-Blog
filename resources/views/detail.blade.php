@extends('layouts.master')
@section('content')
    <h3 class=" mb-2">
        <a href="" class=" text-decoration-none text-dark mb-0">
            {{ $article->title }}
        </a>
    </h3>
    <div class=" mb-4">
        <span class=" badge bg-dark">{{ $article->category->title ?? 'Unknown' }}</span>
        <span class=" badge bg-dark">{{ $article->created_at->format('d M Y') }}</span>
        <span class=" badge bg-dark">{{ $article->user->name }}</span>
    </div>
    <div class="my-3 text-center">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @isset($article->photos)
                @foreach ($article->photos as $key=>$photo)
                    <div class="carousel-item {{$key===0? 'active': ''}}">
                        <a class="my-link" data-gall="myGallery" href="{{asset('storage/'. $photo->name)}}">
                            <img src="{{asset('storage/'. $photo->name)}}" class="d-block w-100 article-detail-img" alt="...">
                        </a>
                      </div>
                @endforeach
            @endisset
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>
    <div class=" mb-3" style="white-space: pre-wrap">
        {{ $article->description }}
    </div>

    <div class="mb-3 text-end">
        @can('article-update', $article)
        <a href="{{ route('article.edit', $article->id) }}" class=" btn  btn-secondary">
            <i class=" bi bi-pencil"></i>
        </a>
        @endcan
        <a href="{{route('index')}}" class="btn btn-secondary">All Articles</a>
    </div>
    @include('layouts.comment')
@endsection
