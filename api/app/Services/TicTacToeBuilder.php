<?php


namespace App\Services;


use App\Contracts\GameBuilderInterface;
use App\Entity\Game;
use App\Entity\Board;

class TicTacToeBuilder implements GameBuilderInterface
{

    public function build(array $data): Game
    {

        $board = new Board($data['gameBoard'],$data['gameSize']);
        $game = new Game($data['gameID'], $data['gameState'], $data['userPlayer']);
        $game->setGameBoard($board);
        return $game;


    }

}
