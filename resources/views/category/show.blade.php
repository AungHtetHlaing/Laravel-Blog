@extends('layouts.app')

@section('content')
    <a href="{{ route('article.index') }}" class=" btn btn-outline-primary">All Articles</a>
    <hr>

    <h4>{{ $article->title }}</h4>

    <div class="">
        {{ $article->description }}
    </div>

@endsection
