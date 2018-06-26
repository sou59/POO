<?php

namespace APP\Game;

use APP\Vehicle\Vehicle;

use APP\Game\Bonus;

// la class ne peut pas être étendue
final class Player {
    use Bonus;
    private $username;
    private $country;
    private $score = 0;
    private $level = 0;
    private $vehicle;
    private $uid;
    private static $counter = 0;
    
    public function __construct($username, $country, Vehicle $vehicle){
        // typage possible en paramètre
        $this->username = $username;
        $this->country = $country;
        $this->vehicle = $vehicle;
        self::$counter++;
        $this->generateId();
    }

        // generer numéro aleatoire
    public function generateId() {
        $this->uid = uniqid(); // fonction avec 2 paramètres facultatif ici pas besoin
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

    public static function save(Player $player) {
        $_SESSION['player'] = serialize($player);
        $player->__destruct();
        unset($player);
   }
   
   // 
    public static function restore( Vehicle $vehicle ) {
       if(!empty($_SESSION['player'])){
           $player = unserialize($_SESSION['player']);
           $player->vehicle = $vehicle;
           return $player;
       }
      return false;
    }
    
    // sauvegarde un tableau avec les éléments que l'on souhaite sauvegarder
    public function __sleep() {
        return ['username', 'country', 'score', 'level'];

    }

        // regénère un id à chaque nouvel session
    public function __wakeup(){
        $this->generateId();
        unset($_SESSION['player']);
        self::$counter++;
    }

    public function __destruct()
    {
        self::$counter--;
    }
    
    

}



