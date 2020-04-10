<?php


namespace App\Contracts;


use App\Entity\Game;

interface GameBuilderInterface
{

    public function build(array $data): Game;

}
