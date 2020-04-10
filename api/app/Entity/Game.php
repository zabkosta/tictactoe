<?php


namespace App\Entity;

use \Illuminate\Log;


class Game
{


    private $gameID;
    /**
     * @var Board
     */
    private $gameBoard;
    private $gameSize;
    private $gameState;


    private $userPlayer;
    private $aiPlayer;

    /**
     * Game constructor.
     * @param int $gameID
     * @param string $gameState
     * @param string $userPlayer
     */
    public function __construct(int $gameID, string $gameState, string $userPlayer)
    {
        $this->gameID = $gameID;
        $this->gameState = $gameState;
        $this->setPlayer($userPlayer);

    }

    /**
     * @return int
     */
    public function getGameID(): int
    {
        return $this->gameID;
    }

    /**
     * @return mixed
     */
    public function getGameState()
    {
        return $this->gameState;
    }

    /**
     * @param string $gameState
     * @return Game
     */
    public function setGameState($gameState): Game
    {
        $this->gameState = $gameState;
        return $this;
    }

    /**
     * @param Board $gameBoard
     */
    public function setGameBoard(Board $gameBoard): void
    {
        $this->gameBoard = $gameBoard;
    }


    public function getAiPlayer()
    {

        return $this->aiPlayer;

    }

    public function setPlayer($userPlayer): Game
    {
        $this->userPlayer = $userPlayer;
        $this->aiPlayer =  $userPlayer === Board::X_PLAYER ? Board::O_PLAYER : Board::X_PLAYER;
        return $this;
    }


    public function makeMove():int
    {
        if ($this->gameState !== 'F'){

            $moveindex =  $this->gameBoard->findBestMoveFor($this->aiPlayer);

            // there is no move
            if (-1 === $moveindex){
                $this->setGameState('F');
                return $moveindex;
            }

            $this->gameBoard->move($moveindex);
            $score = $this->gameBoard->evaluateBoard();

            if ($score !== 0 ) {
                // we have winner
                $this->setGameState('F');
            }
        }

        return $moveindex ?? -1;

    }


    public function getWinner()
    {

        $score = $this->gameBoard->evaluateBoard();

        if ($score === 10) {
            return $this->aiPlayer;
        }

        if ($score === -10){
            return $this->userPlayer;
        }

        return null;


    }





}
