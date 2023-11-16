@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-grid gallary ">
                @forelse (Auth::user()->photos as $photo)
                    <img src="{{asset('storage/'. $photo->name)}}" class=" w-100 rouned my-3" alt="">
                @empty
                    <p>There is no photo yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
