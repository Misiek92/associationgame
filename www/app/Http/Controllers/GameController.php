<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Distribution;
use App\Word;
use App\Game;
use App\Services\DistributionService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

class GameController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $view = view('main');
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
        $game = Game::where('name', $name)->orderBy('id', 'desc')->first();
        $view = view('board')
                ->with('name', $name)
                ->with('words', json_decode($game->distribution->words, true))
                ->with('timestamp', Carbon::now()->timestamp)
                ->with('points1', $game->points_1)
                ->with('points2', $game->points_2);
        return $view;
    }
    
        public function showGameCaptain($name)
    {
        $game = Game::where('name', $name)->orderBy('id', 'desc')->first();
        $view = view('list')
                ->with('name', $name)
                ->with('words', json_decode($game->distribution->words, true))
                ->with('timestamp', Carbon::now()->timestamp)
                ->with('points1', $game->points_1)
                ->with('points2', $game->points_2);
        return $view;
    }
    
    private function checkWordList($words)
    {
        $exist0 = False;
        $exist1 = False;
        $choosenBlack = True;
        foreach ($words as $word) {
            if (!$word->discovered && $word->team == 0) {
                $exist0 = True;
            }
            if (!$word->discovered && $word->team == 1) {
                $exist1 = True;
            }
            if (!$word->discovered && $word->team == 3) {
                $choosenBlack = False;
            }
        }
        if ($choosenBlack) {
            return array("won" => "3");
        }
        if (!$exist0) {
            return array("won" => "0");
        }
        if (!$exist1) {
            return array("won" => "1");
        }
        return false;
    }
    
    public function getDistributionForGame($name)
    {
        $game = Game::where('name', $name)->orderBy('id', 'desc')->first();
        return $game->distribution->words;
        
    }
    
    public function discoverWord()
    {
        $game = Game::where('name', $_POST['game'])->orderBy('id', 'desc')->first();
        $words = json_decode($game->distribution->words, false);
        for ($i = 0; $i < count($words); $i++) {
            if ($words[$i]->word == $_POST['word']) {
                $words[$i]->discovered = true;
            }
        }
        $dist = Distribution::where('id', $game->distribution_id)->first();
        $dist->words = json_encode($words);
        $dist->save();
        $checker = $this->checkWordList($words);
        if ($checker && isset($checker['won'])) {
            if ($checker['won'] != "3") {
                $this->addPointsToGame($_POST['game'], $checker['won']);
            }
            $this->newDistribution($_POST['game']);
            route('newDistribution', ['name' => $_POST['game']]);
            return $checker;
        }
    }
    
    public function addPoints()
    {
        $game = $_POST['game'];
        $team = $_POST['team'];
        $this->addPointsToGame($game, $team);
    }
    
    public function addPointsToGame($game, $team)
    {
        $game = Game::where('name', $game)->orderBy('id', 'desc')->first();
        if ($team == "0") {
            $game->points_1++;
        }
        if ($team == "1") {
            $game->points_2++;
        }
        $game->save();
    }
    
    public function newDistribution($game)
    {
        $game = Game::where('name', $game)->orderBy('id', 'desc')->first();
        
        $distributionService = new DistributionService();
        $words = $distributionService->getRandom25Words();
        
        $dist = new Distribution();
        $dist->words = json_encode($words);
        $dist->save();
        
        $game->distribution_id = $dist->id;
        $game->save();
        
        return $words;
        
    }
}
