<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Game;
use App\Gamesetting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\RandomInt;
use Illuminate\Support\Facades\DB;

class BetController extends Controller
{


    public function __construct()
    {
        // set auth guard
        $this->middleware('auth');
    }


    public function MakeBet(){

        //show make bet view/form
        return view('makebet');
    }

    public function savebet(Request $request){


        // Basic validation for Amount field
        $this->validate($request, [
            'amount' => 'required',
        ]);

        // Define variables
        $amount = $request->amount;
        $betType = $request->betType;
        $userId = Auth::user()->id;
        $userIp = $_SERVER['REMOTE_ADDR'];

        // Check if selected number exists for this bet type
        $selectedNumber = $request->selectedNumber;
        if($selectedNumber == ''){
            //set default selected Number
            $selectedNumber = 0;
        }

        // Create betString
        $betString = "[{\"T\":\"".$betType."\",\"I\":".$selectedNumber.",\"C\":".$amount.",\"K\":1}]";

        // Define Current user
        $currentUser = User::find(Auth::user()->id);

        //Check if user has enough balance for bet
        if($currentUser->balance < $amount){
            //redirect back with error
            return Redirect::back()->withErrors(['balance' => 'You do not have enough balance to make this bet.']);
        }

        // Create CheckBets object
        $checkObject = new CheckBets();
        $validateBet = $checkObject->IsValid($betString);
        $isValid = $validateBet->getIsValid();
        //print_r($betString);
        // Check if bet is valid
        if($isValid == 1){

            // Create new bet object
            $newBet = New Bet();
            // Set new bet object properties
            $newBet->user_id = $userId;
            $newBet->user_ip = $userIp;
            $newBet->betstring = $betString;
            $newBet->amount = $amount;

            // Save New bet
            $newBet->save();

            // get current Jackpot from base
            $gameSettings = Gamesetting::find(1);
            //increase Jackpot by 1% of bet
            $gameSettings->_value = $gameSettings->_value + ($amount *1)/100;
            // Save new jackpot
            $gameSettings->save();

            //decrease User balance for bet
            $newBalance = $currentUser->balance - $amount;
            $currentUser->balance = $newBalance;
            $currentUser->save();

            $betAmount = $validateBet->getBetAmount();
            // Generate Cryptographically secure Int 0-36
            $winnum = random_int ( 0,36);
            // Calculate Estimate Winning amount
            $estimateWin = $checkObject->EstimateWin($betString, $winnum);

            // Create Game Object
            $newGame = New Game();

            // Set Game object properties
            $newGame->bet_id = $newBet->id;
            $newGame->user_id = $userId;
            $newGame->winnum = $winnum;
            $newGame->winamount = $estimateWin;
            $newGame->betamount = $amount;


            if ($estimateWin > 0) {
                // Set won status
                $newGame->won = 'y';

                // Add wonamount to user balance if user did win
                $newBalance = $currentUser->balance + $estimateWin;
                $currentUser->balance = $newBalance;
                $currentUser->save();

            } else {
                // Set won status
                $newGame->won = 'n';
            }

            // Save Game Object
            $newGame->save();

            //redirect user to result page with game id
            return redirect(route('gameresult', $newGame->id));

        }else{
            //return user back with error
            return Redirect::back()->withErrors(['bettype' => 'Invalid bet']);

        }

    }

    public function BetHistory(){

        $userId = Auth::user()->id;
        $games = DB::table('games')->where('user_id' , $userId)->paginate(25);
        return view('gamehistory')->with('games' , $games);
    }


    public function gameresult($gameId){

        $userBalance = Auth::user()->balance;
        $game = Game::find($gameId);

        return view('gameresult')->with(['game' => $game , 'userBalance' => $userBalance]);

}

}
