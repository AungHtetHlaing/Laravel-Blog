@extends('layouts.app')

@section('content')
    <h3>All Articles</h3>
    <hr>
    @if (session('message'))
        <div class=" alert alert-success">{{session('message')}}</div>
    @endif

    <div class=" search-form mb-4">
        <p class=" mb-2 fw-bold">Article Search</p>
        <form action="">
            <div class="input-group">
                <input type="text" class=" form-control" value="{{ request()->keyword }}" name="keyword">
                <button class=" btn btn-dark">
                    <i class=" bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>
    @if (request()->has('keyword'))
        <div class=" d-flex justify-content-between">
            <p class=" mb-2 fw-bold">Showing result by ' {{ request()->keyword }} '</p>
            <a href="{{ route('article.index') }}" class=" text-dark">See All</a>
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Author</th>
                <th>Controls</th>
                <th>Updated at</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>
                        {{ $article->title }}
                        <br>
                        <span class="badge bg-secondary">{{$article->slug}}</span>
                    </td>
                    <td>{{ Str::limit($article->description, 30, '...') }}</td>
                    <td>{{ $article->category->title }}</td>
                    <td>{{ $article->user->name }}</td>
                    <td>
                        <div class=" btn-group">
                            <a href="{{ route('article.show', $article->id) }}" class=" btn btn-sm btn-outline-primary">
                                <i class=" bi bi-info
                                "></i>
                            </a>
                            @can('article-update', $article)
                            <a href="{{ route('article.edit', $article->id) }}" class=" btn btn-sm btn-outline-warning">
                                <i class=" bi bi-pencil"></i>
                            </a>
                            @endcan
                            @can('article-delete', $article)
                            @if(request()->trash)
                            <form class=" d-inline-block mx-2" action="{{ route('article.destroy',  [$article->id,'delete' => "force"]) }}" method="post">
                                @method('delete')
                                @csrf
                                <button class=" btn btn-sm btn-danger">
                                    <i class=" bi bi-trash3-fill"></i>
                                </button>
                            </form>
                            <form class=" d-inline-block" action="{{ route('article.destroy',  [$article->id,'delete' => "restore"]) }}" method="post">
                                @method('delete')
                                @csrf
                                <button class=" btn btn-sm btn-danger">
                                    <i class=" bi bi-recycle"></i>
                                </button>
                            </form>
                            @else
                            <form class=" d-inline-block ms-2" action="{{ route('article.destroy',  [$article->id,'delete' => "soft"]) }}" method="post">
                                @method('delete')
                                @csrf
                                <button class=" btn btn-sm btn-danger">
                                    <i class=" bi bi-trash3"></i>
                                </button>
                            </form>

                            @endif
                            @endcan
                        </div>


                    </td>
                    <td>
                        <p class="small mb-0">
                            <i class=" bi bi-clock"></i>
                            {{$article->updated_at->format("h:i a")}}
                        </p>
                        <p class="small mb-0">
                            <i class=" bi bi-calendar"></i>
                            {{$article->updated_at->format("d M Y")}}
                        </p>
                    </td>
                    <td>
                        <p class="small mb-0">
                            <i class=" bi bi-clock"></i>
                            {{$article->created_at->format("h:i a")}}
                        </p>
                        <p class="small mb-0">
                            <i class=" bi bi-calendar"></i>
                            {{$article->created_at->format("d M Y")}}
                        </p>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class=" text-center" colspan="7">
                        <p>There is no article</p>
                        <a href="{{ route('article.create') }}" class=" btn btn-sm btn-primary">Create Now</a>
                    </td>
                </tr>
            @endempty
        </tbody>
    </table>

    {{$articles->links()}}
@endsection
