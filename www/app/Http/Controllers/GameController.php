<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Distribution;
use App\Word;
use App\Game;
use App\Services\DistributionService;

class GameController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $view = view('test')->with('name', 'Victoria');
        return $view;
    }
    
    public function createGame($name)
    {
        $game = new Game();
        $game->name = $name;
        
        $distributionService = new DistributionService();
        $words = $distributionService->getRandom25Words();
        
        $dist = new Distribution();
        $dist->words = json_encode($words);
        $dist->save();
        
        $game->distribution_id = $dist->id;
        $game->save();
        
        return $dist->words;
    }
    
    public function showGame($name)
    {
        $game = Game::where('name', $name)->first();
        $view = view('board')->with('name', $name)->with('words', json_decode($game->distribution->words, true));
        return $view;
    }
    
}
