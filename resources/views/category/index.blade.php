@extends('layouts.app')

@section('content')
    <h3>All Categories</h3>
    <hr>
    @if (session('message'))
        <div class=" alert alert-success">{{session('message')}}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th>Controls</th>
                <th>Updated at</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>
                        {{ $category->title }}
                        <br>
                        <span class="badge bg-secondary">{{$category->slug}}</span>
                    </td>
                    <td>{{ $category->user_id }}</td>
                    <td>
                        <div class=" btn-group">
                            <a href="{{ route('category.edit', $category->id) }}" class=" btn btn-sm btn-outline-warning">
                                <i class=" bi bi-pencil"></i>
                            </a>
                            <button form="categoryDeleForm{{$category->id}}" class=" btn btn-sm btn-danger">
                                <i class=" bi bi-trash3"></i>
                            </button>
                        </div>

                        <form id="categoryDeleForm{{$category->id}}" class=" d-inline-block" action="{{ route('category.destroy', $category->id) }}" method="post">
                            @method('delete')
                            @csrf

                        </form>
                    </td>
                    <td>
                        <p class="small mb-0">
                            <i class=" bi bi-clock"></i>
                            {{$category->updated_at->format("h:i a")}}
                        </p>
                        <p class="small mb-0">
                            <i class=" bi bi-calendar"></i>
                            {{$category->updated_at->format("d M Y")}}
                        </p>
                    </td>
                    <td>
                        <p class="small mb-0">
                            <i class=" bi bi-clock"></i>
                            {{$category->created_at->format("h:i a")}}
                        </p>
                        <p class="small mb-0">
                            <i class=" bi bi-calendar"></i>
                            {{$category->created_at->format("d M Y")}}
                        </p>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class=" text-center" colspan="7">
                        <p>There is no category</p>
                        <a href="{{ route('category.create') }}" class=" btn btn-sm btn-primary">Create Now</a>
                    </td>
                </tr>
            @endempty
        </tbody>
    </table>

    {{-- {{$categorys->links()}} --}}
@endsection
