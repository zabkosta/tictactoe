<?php


namespace App\Entity;


class Game
{

    public const X_PLAYER = 'X';
    public const O_PLAYER = 'O';

    private $gameID;

    private $gameBoard;


    public function createGame(){
        $this->gameBoard = new Board();
        $this->gameID = random_int(100,9999);
        return $this;
    }

}
