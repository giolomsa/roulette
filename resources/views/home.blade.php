@extends('layouts.app')
@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 ">

                <h2>Current Jackpot <span id="jackpot">{{$jackpot->_value}} </span> Cents</h2>
                <h4>Your Balance {{$balance}} Cents</h4>
            </div>
        </div>
    </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {

            var baseurl = {!! json_encode(url('/')) !!};

            var fullurl = baseurl + "/roulette/getjackpot/";

            $(document).ready(function () {

                setInterval(function () {

                    $.post(fullurl,
                        {},
                        function (data) {
                            document.getElementById("jackpot").innerHTML = data;
                        });

                }, 1000);
            });
        });
    </script>
@endsection
