@extends('layouts.app')

@section('head', 'Create Short Link')

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
                    <input name="url" type="text" class="form-control" placeholder="url">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">Short</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection