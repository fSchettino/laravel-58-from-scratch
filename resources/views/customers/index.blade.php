@extends('layouts.app')

@section('title')
    Customers List - Laravel 5.8 Practice Project
@endsection

@section('content')
    <div class="rw">
        <div class="col-12">
            <h1>Customers List</h1>
        </div>
    </div>

    {{--check if a user has priviledges for customer creation--}}
    @can('create', App\Customer::class)
        <div class="row pb-3">
            <div class="col-12">
                <p><a href="customers/create">Add new customer</a></p>
            </div>
        </div>
    @endcan

    <div class="row">
        <div class="col-1"><strong>ID</strong></div>
        <div class="col-3"><strong>Name</strong></div>
        <div class="col-3"><strong>Email</strong></div>
        <div class="col-3"><strong>Company</strong></div>
        <div class="col-2"><strong>Status</strong></div>
    </div>
    <hr>
    @foreach($customers as $customer)
        <div class="row">
            <div class="col-1">{{ $customer->id }}</div>
            <div class="col-3">
                @can('view', $customer)
                    <a href="/customers/{{ $customer->id }}">{{ $customer->name }}</a>
                @endcan
                @cannot('view', $customer)
                    {{ $customer->name }}
                @endcannot

            </div>
            <div class="col-3">{{ $customer->email }}</div>
            <div class="col-3">{{ $customer->company->name }}</div>
            {{--Using ternary operator--}}
            {{--<div class="col-2">{{ $customer->active ? 'Active' : 'Inactive'}}</div>--}}
            <div class="col-2">{{ $customer->active }}</div>
        </div>
    @endforeach

    <div class="row pt-5">
        <div class="col-12 d-flex justify-content-center">
            {{ $customers->links() }}
        </div>
    </div>
@endsection
