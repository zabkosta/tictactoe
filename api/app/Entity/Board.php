<?php

namespace App\Entity;

class Board {

    /**
     *  Board dimension, default 3x3
     * @var int
     */
    private $dimension;

	private $board = [];

	public function __construct($dimension = 3)
    {
        $this->dimension = $dimension;

        for ($i = 0; $i < $dimension; $i++) {
            for ($j = 0; $j < $dimension; $j++) {
                $this->board[$i][$j] = NULL;
            }
        }
    }

    public function isPlayerWin(string $player):bool
    {
        // check major diagonal
        $d1 = False;
        for ($i = 0, $j=0; $i < $this->dimension; $i++, $j++) {
            $d1 = $d1 &&  ($this->board[$i][$j] === $player);
        }

        // check minor diagonal
        $d2 = False;
        for ($i = 0, $j=0; $i < $this->dimension; $i++, $j--) {
            $d2 = $d2 &&  ($this->board[$i][$j] === $player);
        }


        // check horizontal lines function
        // returns True if any line completely filled with given player mark ( 'X' or 'O')

        $lineCheck = static function(array $board, $player):bool
                {
                    $res = False;
                    foreach ($board as $line){
                        // $field is an array which represents horizontal
                        //check given line
                        $lineResult = array_reduce($line, static function ($carry, $value) use($player){
                            return $carry && ($value === $player);
                        }, False);
                        // if any line will True, final result also will be True
                        $res = $res && $lineResult;
                    }
                    return $res;
                };

        //check horizontal
        $d3 = $lineCheck($this->board, $player);

        // check verticals
        // transponce array
        $transponded = array_map(NULL, ...$this->board);
        $d4 = $lineCheck($transponded , $player);

        return $d1 || $d2 || $d3 || $d4;
    }



	public function makeMove(string $player){

	    $index = $this->getBestMove($player);
	    $this->board[$index] = $player;
	    return $this;
    }

    public function getBoard():array
    {

        return $this->board;

    }



    /**
     *  Return array of available fields
     * @return array
     */
    private function  findAvailableFields()
	{
		return array_filter($this->board, function($value) {
            return $value !== self::O_PLAYER && $value !== self::X_PLAYER;
        });
	}

	private function getBestMove($player):int
    {



    }





}
