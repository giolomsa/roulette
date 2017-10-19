@extends('layouts.app')

@section('title')
    Game Status
@endsection
@section('content')
    <div class="container">
        <div class="row">

            <h4>Spin ID: {{$game->id}}</h4>
            <h1 class="text-success">Winning Number is {{$game->winnum}}</h1>
            @if($game->won == 'y')
                <h4>
                    Congratulations! You win: {{$game->winamount}}<b></b> Cents
                </h4>
            @else
                <h4 class="text-danger">Unfortunately you did not win.</h4>
            @endif

            <h4>Your Balance: {{$userBalance}} Cents</h4>
            <a class="btn btn-success" href="{{url('/')}}/addbet">Make another Bet</a>

        </div>
    </div>
@endsection
