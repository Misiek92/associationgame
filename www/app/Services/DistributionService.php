<?php

namespace App\Services;

use App\Distribution;
use App\Word;
use DB;

class DistributionService
{

    /**
     * Generating array structure for game
     * @return $words[]
     */
    public function getRandom25Words()
    {
        $words = Word::orderBy(DB::raw('RAND()'))->limit(25);
        
        $words->increment('used');

        $words = $words->get(['word'])->toArray();

        
        $ids = $this->uniqueRandomIds(0, 24, 16);
        $deathId = $this->uniqueRandomIds(0, 15, 1)[0];
        $deathNumber = $ids[$deathId];
        array_splice($ids, $deathId, 1);
        sort($ids);
        $team = $this->uniqueRandomIds(0, 1, 1)[0];
        
        
        for ($i = 0; $i < count($words); $i++) {
            $words[$i]['team'] = 2;
            $words[$i]['discovered'] = False;
            if (!empty($ids) && $i == $ids[0]) {
                $words[$i]['team'] = $team;
                $team = ($team == 1 ? 0 : 1);
                array_splice($ids, 0, 1);
            } else if ($i == $deathNumber) {
                $words[$i]['team'] = 3;
            }
            
        }

        return $words;
    }

    public function uniqueRandomIds($min, $max, $quantity)
    {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }

}
