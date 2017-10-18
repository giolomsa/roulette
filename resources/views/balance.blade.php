@extends('layouts.app')

@section('title')
    Balance
@endsection
@section('content')
    <div class="container">
        <div class="row">

            <h4>
                Your balance is: <b>{{$balance}}</b> Cents
            </h4>

            <a href="#" class="btn btn-success">Add ballance</a>
        </div>
    </div>
@endsection
