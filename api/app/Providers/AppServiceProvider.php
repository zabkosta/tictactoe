<?php

namespace App\Providers;

use App\Contracts\GameBuilderInterface;
use App\Services\TicTacToeBuilder;

class AppServiceProvider extends ServiceProvider
{

    public $bindings = [
        TicTacToeBuilder::class => TicTacToeBuilder::class,
    ];


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
