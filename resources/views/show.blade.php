@extends('layouts.app')

@section('head', 'Short Link')

@section('body')
    <div class="container ">
        <div class="jumbotron mt-3">
            <h1 class="display-4">Url-Shortner</h1>
            <p class="lead">Simple page that shortens url</p>
            <hr class="my-4">
            <p>Your short Url:</p>
            <div class="mb-3 h1">
                <a href="{{ route('links.show', $link->code) }}" class="badge badge-info text-s">{{ route('links.show', $link->code) }}</a>
            </div>
        </div>
    </div>
    @endsection
