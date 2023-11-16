@extends('layouts.app')

@section('content')
    <h3>All users</h3>
    <hr>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Role</th>
                <th>Controls</th>
                <th>Updated at</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        {{ $user->name }}
                        <br>
                        <span class=" small text-black-50">
                            {{$user->email}}
                        </span>
                    </td>
                    <td>
                        {{ $user->role }}
                    </td>
                    <td>

                    </td>
                    <td>
                        <p class="small mb-0">
                            <i class=" bi bi-clock"></i>
                            {{$user->updated_at->format("h:i a")}}
                        </p>
                        <p class="small mb-0">
                            <i class=" bi bi-calendar"></i>
                            {{$user->updated_at->format("d M Y")}}
                        </p>
                    </td>
                    <td>
                        <p class="small mb-0">
                            <i class=" bi bi-clock"></i>
                            {{$user->created_at->format("h:i a")}}
                        </p>
                        <p class="small mb-0">
                            <i class=" bi bi-calendar"></i>
                            {{$user->created_at->format("d M Y")}}
                        </p>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class=" text-center" colspan="5">
                        <p>There is no user</p>
                    </td>
                </tr>
            @endempty
        </tbody>
    </table>

    {{$users->links()}}

@endsection
