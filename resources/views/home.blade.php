@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-5 pl-5">
        <div class="row">
            <div class="col-lg-2">
                <img src="{{ 'http://'.str_replace('api/', '', config('app.api_base_url')).$users['identity_card'] }}"
                     alt="identity_card">
            </div>
            <div class="col">
                <h3> {{ 'Name : '.$users['name'] }} </h3>
                <h3> {{ 'Email : '.$users['email'] }} </h3>
            </div>
        </div>
    </div>
@endsection
