<?php

use App\Entity\Game;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {


        $validatedData =  [
            'gameID' => 1,
            'gameSize' => 3,
            'gameBoard' => ['X',null,null,null,null,null,null,null,null],
            'game.gameState' => 'RUN',
            'game.userPlayer' => 'X'
            ];




    }
}
