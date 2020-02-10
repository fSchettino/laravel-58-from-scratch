@extends('layouts.app')

@section('title', 'Link page')

@section('content')
    <h1>Dummy page</h1>
    <p>
        Dummy page created to show how to pass data among views. <br>
        Page name and url are passed by layout to nav Blade template.
    </p>
    <a href="/">Back to home page</a>
@endsection
