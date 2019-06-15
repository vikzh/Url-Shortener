@extends('layouts.app')

@section('title', 'Create Short Link')

@section('body')
    <div class="container">
        <div class="jumbotron mt-3">
            <h1 class="display-4">Url-Shortner</h1>
            <p class="lead">Simple page that shortens url</p>
            <hr class="my-4">
            <p>Enter URL to short:</p>
            <div class="mb-3">
                <form action="{{ route('links.store') }}" class="input-group input-group-lg" method="post">
                    @csrf
                    <input name="url-to-short" type="text" class="form-control" placeholder="url">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">Shorten</button>
                    </div>
                </form>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection
