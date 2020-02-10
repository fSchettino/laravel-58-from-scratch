@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="pb-3">You are logged in!</div>

                    {{--Vue component--}}
                    <custom-button btn_type="submit" label="My label"></custom-button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
