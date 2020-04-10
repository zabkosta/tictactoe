<?php

namespace App\Entity;

class Board {

    public const X_PLAYER = 'X';
    public const O_PLAYER = 'O';

    /**
     *  Board dimension
     * @var int
     */
    private $gameSize;

    /**
     * Represent board as one-dimension array
     * @var array
     */
	private $gameBoard;

	private $maximizer;
	private $minimizer;


	public function __construct(array $board , int $size)
    {

        $this->gameSize = $size;
        $this->gameBoard = $board;
    }

    public function move(int $inx):void
    {
            $this->gameBoard[$inx]  = $this->maximizer;

    }


    public function findBestMoveFor($player): int
    {
        // init players
        $this->setPlayers($player);


        $bestCost = -1000;
        $bestIndex = -1;

        foreach ($this->getAvailableMove() as $index) {

            $this->gameBoard[$index] = $this->maximizer;

            $moveCost = $this->minimax(0, false);

            $this->gameBoard[$index] = null;

            if ($moveCost > $bestCost)
            {
                $bestIndex = $index;
                $bestCost = $moveCost;
            }

        }


        return $bestIndex;
    }



    private function setPlayers(string $maxPlayer):void
    {
        $this->maximizer = $maxPlayer;
        $this->minimizer =  $maxPlayer === self::X_PLAYER ? self::O_PLAYER : self::X_PLAYER;
    }


    /**
     *  Return array of available fields
     * @return array
     */
    private function  getAvailableMove():array
    {

        return array_keys($this->gameBoard, null);

    }


    private function minimax(int $depth, bool $isMaximizer):int
    {

        $score = $this->evaluateBoard();


        if ($score === 10){
            return $score;
        }

        if ($score === -10){
            return $score;
        }

        $availableMoves = $this->getAvailableMove();

        if (empty($availableMoves))
        {
            return 0;
        }

        if ($isMaximizer){

               $best = -1000;

            // Traverse all available cells
              foreach ( $availableMoves as $minx){

                  // Make the move
                  $this->gameBoard[$minx] = $this->maximizer;
                  $value = $this->minimax($depth+1, !$isMaximizer);
                  if ($value > $best){
                      $best = $value;
                  }
                  $this->gameBoard[$minx] = null;

              }

             return $best;
        }

        $best = 1000;

        // Traverse all cells
        foreach ( $availableMoves as $minx) {

            // Make the move
            $this->gameBoard[$minx] = $this->minimizer;
            // dd($this->gameBoard);
            $value = $this->minimax($depth + 1, !$isMaximizer);

            if ($value < $best) {
                $best = $value;
            }

            $this->gameBoard[$minx] = null;
        }
        return $best;
    }


    public function evaluateBoard():int
    {

        if ($this->isPlayerWin($this->maximizer)) {
            return 10;
        }

        if ($this->isPlayerWin($this->minimizer)) {
            return -10;
        }

        return 0;

    }


    private function isPlayerWin(string $player):bool
    {
        // check major diagonal
        $d1 = true;
        for ($i = 0; $i < $this->gameSize; $i++) {
            $d1 = $d1 &&  ($this->gameBoard[$i*$this->gameSize + $i] === $player);
        }
        // bypass further checking if win
        if ($d1) {
            return $d1;
        }

        // check minor diagonal
        $d2 = true;
        for ($i = 0; $i < $this->gameSize; $i++) {
            $inx = $i*$this->gameSize + $this->gameSize - 1 - $i;
            $d2 = $d2 &&  ($this->gameBoard[$inx] === $player);
        }
        // bypass further checking if win
        if ($d2) {
            return $d2;
        }



        $d3 = false;
        for ($i = 0; $i < $this->gameSize; $i++) {

            $line = array_slice($this->gameBoard,$i*$this->gameSize, $this->gameSize);
            $lineResult = array_reduce($line, static function ($carry, $value) use($player){
                return $carry && ($value === $player);
            }, true);
            $d3 = $d3 || $lineResult;
        }
        // bypass further checking if win
        if ($d3) {
            return $d3;
        }


        $d4 = false;
        for ($i = 0; $i < $this->gameSize; $i++) {
          $lineResult = true;
          for ($j=$i; $j < $this->gameSize*$this->gameSize; $j += $this->gameSize){

              $lineResult = $lineResult && ($this->gameBoard[$j] === $player);
         }
          $d4 = $d4 || $lineResult;
       }


        return $d4;
    }






}
