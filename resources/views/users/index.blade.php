@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-header bg-dark text-white d-flex justify-content-between">
                <h3 class="card-title">List of users</h3>
                <a href="{{ route('users.create') }}" class="btn">Add user</a>
            </div>
            <div class="card-body">
                <div id="table-default" class="table-responsive">
                    <table class="table table-hover pt-3" id="myTable">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>ADMINISTRATOR</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->admin ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $user) }}" class="btn">Edit</a>
                                        <form action="{{ route('users.destroy', $user) }}" class="d-inline-block" method="post">
                                            @csrf @method('delete')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
