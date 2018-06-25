<?php

namespace APP\Game;

use APP\Vehicle\Vehicle;

// la class ne peut pas être étendue
final class Player {
    private $username;
    private $country;
    private $score = 0;
    private $level = 0;
    private $vehicle;
    private static $counter = 0;
    
    public function __construct($username, $country, Vehicle $vehicle){
        // typage possible en paramètre
        $this->username = $username;
        $this->country = $country;
        $this->vehicle = $vehicle;
        self::$counter++;

    }

    public function levelUp(){
        $this->level++;
    }
    public function updateScore( $score ){
        $this->score += $score;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getCountry(){
        return $this->country;
    }
    public function getScore(){
        return $this->score;
    }
    public function getLevel(){
        return $this->level;
    }
    public function getVehicle(){
        return $this->vehicle;
    }
    public static function getCounter() {
        return self::$counter;
    }

}



