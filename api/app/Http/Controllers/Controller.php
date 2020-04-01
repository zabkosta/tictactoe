<?php

namespace App\Http\Controllers;

use App\Entity\Board;
use App\Entity\Game;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

    public function create()
    {
        $board = new Board();

        $win = $board->isPlayerWin(Game::X_PLAYER);

        dd($board, $win);
    }
}
