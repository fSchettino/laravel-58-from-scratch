@extends('layouts.app')

@section('title')
    Edit detail for {{ $customer->name }} - Laravel 5.8 Practice Project
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Edit detail for {{ $customer->name }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="/customers/{{ $customer->id }}" method="post" enctype="multipart/form-data">

                @method('patch')
                @include('customers.form')

                <button type="submit" class="btn btn-primary">Save customer</button>

            </form >
        </div>
    </div>
@endsection
