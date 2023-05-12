@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <livewire:client-translate-form />
                <livewire:user-translate-form />
            </div>
        </div>
    </div>
@endsection
