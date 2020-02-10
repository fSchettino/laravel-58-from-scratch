@extends('layouts.app')

@section('title')
    Contact - Laravel 5.8 Practice Project
@endsection

@section('content')
    @if(!session()->has('message'))
        <h1>Contact Us</h1>
        <form action="/contact" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="name" class="form-control" id="name" name="name" value="{{ old('name') }}">
                <small id="nameValidationMsg">{{ $errors->first('name') }}</small>
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                <small id="emailValidationMsg">{{ $errors->first('email') }}</small>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="10" class="form-control">{{ old('message') }}</textarea>
                <small id="emailValidationMsg">{{ $errors->first('message') }}</small>
            </div>

            @csrf

            <button type="submit" class="btn btn-primary">Send message</button>
        </form>
    @else
        <a href="/">Back to home page</a>
    @endif
@endsection
