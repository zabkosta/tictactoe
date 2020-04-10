<?php

namespace App\Http\Controllers;

use App\Entity\Board;
use App\Entity\Game;
use App\Services\TicTacToeBuilder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

    public function move(Request $request,  TicTacToeBuilder $builder)
    {
        // get and check request
        $validatedData = $this->validate($request,[
            'game.gameID' => 'required|integer',
            'game.gameSize' => 'required|integer',
            'game.gameBoard' => 'required|array',
            'game.gameState' => 'required',
            'game.userPlayer' => ['required', 'alpha','max:1', Rule::in([Board::O_PLAYER,Board::X_PLAYER])],
        ]);

        $validatedData = $validatedData['game'];

        // initialize Game
        //
//        $game = new Game($validatedData['gameID']);
//        $game->setBoard($validatedData['gameBoard'],$validatedData['gameSize'])
//             ->setGameState($validatedData['gameState'])
//             ->setPlayer($validatedData['userPlayer']);
//
//
//        // get Best Move
//        $move = $game->findBestMove();


        $game = $builder->build($validatedData);
        $move = $game->makeMove();

        return [
            'gameID' => $game->getGameID(),
            'gameState' => $game->getGameState(),
            'nextMove' => $move,
            'aiPlayer' => $game->getAiPlayer(),
            'winner' => ($move < 0 || $game->getGameState() === 'F') ? $game->getWinner(): null
         ];

    }


    public function test(Request $request, TicTacToeBuilder $builder)
    {



        $validatedData =  [
            'gameID' => 1,
            'gameSize' => 3,
            'gameBoard' => ['X',null,null,null,null,null,null,null,null,],
            'gameState' => 'RUN',
            'userPlayer' => 'X'
        ];


        $game = $builder->build($validatedData);

        $move = $game->makeMove();


        dd($move);


    }
}
