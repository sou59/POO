<?php

namespace APP\Game;

use APP\Vehicle\Vehicle;

class Run {
    // tracé de la course
    private $track;
    // nb de tours
    private $laps;
    // comme il sagit d'un tableau on va l'ecrire au pluriel
    private $players = array();
    // classement ordre de place dans la grille d'arrivée
    private $ranking = array();

    // tableau avec tous les circuits
    private static $tracks = ['Monza', 'Indianapolis', 'SPA', 'Monaco'];

    public function __construct($track, $laps = 3) {
        $this->track = $track;
        $this->laps = $laps;
    }
    // personne ne peut y accéder de l'extérieur, on l'appelera dans simulate
    // sur la class Player on ajoute les joueurs
    public function addPlayer( Player $player ) {
        $this->players[] = $player;
        // on peut aussi l'écrire ainsi : array_push($this->players, $player);
    }

    // Création d'une méthode statique générant automatiquement une course
    public static function generateRun() {
        // create new Run
        // nb de circuit et nobre de tours

        // tiré un cirduit aléatoirement:
        //1ere méthode fonction array_rand
        $randomTrack = array_rand(self::$tracks);
        // générerer un nombre de tour
        $laps = rand(1, 10);

        return new Run(self::$tracks[$randomTrack], $laps);
        //2e méthode fonction manuelle
    }

    public function simulate(){
        // Boucles pour  créer un tableau avec les joueurs
        foreach ( $this->players as $player  ) {
            $pos = $this->generatePos( $player );
            $failed = $this->generateEvent( $player );

            $this->ranking[] = [
                'position' => $pos,
                'failed' => $failed,
                'player' => $player,
            ];

        }
       // var_dump($this->ranking);
        $this->sortRanking();
        $this->updatePlayers();
        self::generateRun();
        $this->showRanking();
        
    }

    private function generatePos( Player $player ) {
        $poids = $player->getVehicle()->getWeight();
        // calcul du coeficient
        $max = 100 * $poids;

        // tours par rapport au poids du véhicule
        if ($poids === Vehicle::LOW_WEIGHT) {
            $max +=10 * $this->laps;
        }else if ($poids === Vehicle::HEAVY_WEIGHT){
            $max -=10 * $this->laps;
        }
        $player->getVehicle()->powerUp();
        return rand(1, $max);
    }

    private function generateEvent( Player $player) {
        $poids = $player->getVehicle()->getWeight();
        $max = 10 * $poids;
        $max += 5 * $player->getLevel();
        $rand = rand(1, $max);

        if( $rand == 1 ) {
            return true;
        } 
            return false;
    }

    private function sortRanking() {
        // pas de parametre pour la fonction sortRanking 
        usort($this->ranking, function($a, $b){
            if($a['failed'] === true) {
                return 1;
            }
            else if ($b['failed'] === true) {
                return -1;
            }
            return $a['position'] - $b['position'];
        });

        //var_dump($this->ranking);
    }

    private function updatePlayers() {
        $this->ranking;
        
       // var_dump($this->ranking);
        $points = count($this->ranking);
       // var_dump($lg);
        foreach ($this->ranking as $index => $rank){
            if($index == 0) {
                $rank['player']->levelUp();
            }
            $rank["player"]->updateScore($points);
            $points--;
        }

    }


    // affichage des données
    private function showRanking(){
        echo 'Grand prix de <strong></strong>' .$this->track. "</strong><br \>";
        echo count($this->players). " participant au début de la course et ". (Player::getCounter()-count($this->players)). " spectateurs. <br \>";
        echo 'Classement général : <br \>';

        foreach ($this->ranking as $index => $rank) {
            if( $rank["failed"] === false) {
                echo '#' . ($index+1) . '-' .$rank["player"]->getUsername(). "<br \>";
                echo "Pays : " .$rank["player"]->getCountry(). "<br \>";
                echo "Véhicule : " .$rank["player"]->getVehicle()->getModel(). "<br \>";
                echo "Poids du véhicule : " .$rank["player"]->getVehicle()->getWeight(). "<br \>";
                echo 'Niveau : '.$rank["player"]->getLevel(). "<br \>";
                echo 'Score : '.$rank["player"]->getScore().'<br \>';
                echo '<br \>';
            } else {
                echo $rank['player']->getUsername() . ' : abondon <br \>';
                
            }

        }

    }




}
