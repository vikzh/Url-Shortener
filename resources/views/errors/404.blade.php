@extends('layouts.app')

@section('title', '404')

@section('body')
    <div class="container">
        <div class="jumbotron mt-3">
            <h1 class="display-4">404 Link is not found</h1>
            <p class="lead">Simple page that shortens url</p>
            <hr class="my-4">
            <p>try to shorten the link:</p>
            <div class="mb-3">
                <a href="{{ route('links.create') }}" class="btn btn-info">Сreate a Short Link</a>
            </div>
        </div>
    </div>
@endsection