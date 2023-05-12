@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="card col-8 offset-2">
            <div class="card-header bg-dark text-white d-flex justify-content-between">
                <h3 class="card-title">Create user</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    @include('users.form')

                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
