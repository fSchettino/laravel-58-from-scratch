@extends('layouts.app')

@section('title', ' Details for ' . $customer->name)

@section('content')
    <div class="row pb-3">
        <div class="col-12">
            <h1>Details for {{ $customer->name }}</h1>
            <p><a href="/customers/{{ $customer->id }}/edit">Edit</a></p>
            <form action="/customers/{{ $customer->id }}" method="post">
                @method('delete')
                @csrf
                <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <p><strong>Name: </strong>{{ $customer->name }}</p>
            <p><strong>Email: </strong>{{ $customer->email }}</p>
            <p><strong>Comapny: </strong>{{ $customer->company->name }}</p>
            <p><strong>Status: </strong>{{ $customer->active }}</p>
        </div>
    </div>

    @if($customer->image)
        <div class="row">
            <div class="col-12">
                <img src="{{ asset('storage/' . $customer->image) }}" alt="Profile image" class="img-thumbnail">
            </div>
        </div>
    @endif
@endsection
