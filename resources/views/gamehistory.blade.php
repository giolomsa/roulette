@extends('layouts.app')
@section('title')
    Game History
@endsection

@section('content')
    <div class="container col-lg-12">
        <div class="row">
            <table class="table table-responsive table-striped">
                <thead>
                <tr>
                    <td>Spin ID</td>
                    <td>Bet Amount (USD Cents)</td>
                    <td>Won Amount (USD Cents)</td>
                    <td>Date</td>
                </tr>
                </thead>

                <tbody>
                @foreach($games as $game)
                    <tr>
                        <td>{{$game->id}}</td>
                        <td>{{$game->betamount}}</td>
                        <td>{{$game->winamount}}</td>
                        <td>{{$game->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4" class="text-center">{{$games->links()}}</td>
                </tr>
                </tfoot>

            </table>

        </div>
    </div>
@endsection
