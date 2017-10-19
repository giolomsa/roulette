@extends('layouts.app')

@section('title')
    Make Bet
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="error">
                @if($errors->has('bettype'))
                    <h4>{{$errors->first('bettype')}}</h4>
                @endif
                @if($errors->has('balance'))
                    <h4>{{$errors->first('balance')}}</h4>
                @endif
            </div>
            <form action="{{url('/')}}/savebet" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" id="bettype" name="betType" value="n">

                <div class="form-group">
                    <label for="amount">Bet Amount (USD Cents)</label>
                    <input type="number" class="form-control {{ $errors->has('amount')  }}" id="amount" name="amount"
                           value="0">
                    @if ($errors->has('amount'))
                        <small class="error">{{ $errors->first('amount') }}</small>
                    @endif
                </div>

                <div><b>Bet Type</b></div>

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#n" onclick="setType('n');">N</a></li>
                    <li><a data-toggle="tab" href="#v" onclick="setType('v');">V</a></li>
                    <li><a data-toggle="tab" href="#v" onclick="setType('h');">H</a></li>
                    <li><a data-toggle="tab" href="#v" onclick="setType('s');">S</a></li>
                    <li><a data-toggle="tab" href="#v" onclick="setType('c');">C</a></li>
                    <li><a data-toggle="tab" href="#v" onclick="setType('d');">D</a></li>
                    <li><a data-toggle="tab" href="#v" onclick="setType('row');">Row</a></li>
                    <li><a data-toggle="tab" href="#v" onclick="setType('twelve');">Twelve</a></li>
                    <li><a data-toggle="tab" href="#v" onclick="setType('half');">Half</a></li>
                    <li><a data-toggle="tab" href="#even" onclick="setType('even');">Even</a></li>
                    <li><a data-toggle="tab" href="#odd" onclick="setType('odd');">Odd</a></li>
                    <li><a data-toggle="tab" href="#red" onclick="setType('red');">Red</a></li>
                    <li><a data-toggle="tab" href="#black" onclick="setType('black');">Black</a></li>
                </ul>
                {{--"n", "v", "h", "s", "c", "d", "row", "twelve", "half", "even", "odd", "red", "black"--}}

                <div class="tab-content">

                    <div id="v" class="tab-pane fade in active">
                        <div class="form-group">
                            <br>
                            Select a Number
                            <select name="selectedNumber" id="selectedNumber">
                                @for($i = 0; $i<=36; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div id="even" class="tab-pane fade in ">
                        <div class="form-group">
                            <br>
                            Selected Even Numbers
                        </div>
                    </div>

                    <div id="odd" class="tab-pane fade in ">
                        <div class="form-group">
                            <br>
                            Selected Odd Numbers
                        </div>
                    </div>

                    <div id="red" class="tab-pane fade in ">
                        <div class="form-group">
                            <br>
                            Selected Red Numbers
                        </div>
                    </div>

                    <div id="black" class="tab-pane fade in ">
                        <div class="form-group">
                            <br>
                            Selected Black Numbers
                        </div>
                    </div>


                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Add Bet">
                </div>

            </form>
            <img src="{{url('/')}}/images/table.jpg">

            {{--"n", "v", "h", "s", "c", "d", "row", "twelve", "half", "even", "odd", "red", "black"--}}
        </div>
    </div>

    <script>
        // set bet type
        function setType(selectedType) {
            // change type input value
            document.getElementById('bettype').value = selectedType;

            // change numbers select's options
            switch (selectedType) {
                case 'n' :
                    ChangeSelect(0, 36);
                    break;
                case 'v' :
                    ChangeSelect(0, 36);
                    break;
                case 'h' :
                    ChangeSelect(0, 36);
                    break;
                case 's' :
                    ChangeSelect(0, 36);
                    break;
                case 'c' :
                    ChangeSelect(0, 36);
                    break;
                case 'd' :
                    ChangeSelect(0, 36);
                    break;
                case 'row' :
                    ChangeSelect(1, 3);
                    break;
                case 'twelve' :
                    ChangeSelect(1, 3);
                    break;
                case 'half' :
                    ChangeSelect(1, 2);
                    break;
                case 'even' :
                    ChangeSelect(1, 1);
                    break;
                case 'odd' :
                    ChangeSelect(1, 1);
                    break;
                case 'red' :
                    ChangeSelect(1, 1);
                    break;
                case 'black' :
                    ChangeSelect(1, 1);
                    break;

                default :
            }

            //change numbers select by bet types
            function ChangeSelect(optionFrom, optionsTo) {
                var numberSelect = document.getElementById("selectedNumber");

                //clear select options
                numberSelect.options.length = 0;
                // add new options by bet types
                for (i = optionFrom; i <= optionsTo; i++) {
                    var option = document.createElement("option");
                    option.text = i;
                    option.value = i;
                    numberSelect.add(option);
                }

            }


        }


    </script>
@endsection
