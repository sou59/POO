<?php
class Run {
    // tracé de la course
    private $track;
    // nb de tours
    private $laps;
    // comme il sagit d'un tableau on va l'ecrire au pluriel
    private $players = array();
    // classement ordre de place dans la grille d'arrivée
    private $ranking = array();

    public function __construct($track, $laps = 3) {
        $this->track = $track;
        $this->laps = $laps;
    }

// personne ne peut y accéder de l'extérieur, on l'appelera dans simulate
   
    // sur la class Player
    public function addPlayer( Player $player ) {
        $this->players[] = $player;
        // array_push($this->players, $player);
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
        $this->showRanking();
    }

    private function generatePos( Player $player) {
        $poids = $player->getVehicle()->getWeight();
        // calcul du coeficient
            $max = 100 * $poids;

            // tours
            if ($poids == 1) {
                $max +=10 * $this->laps;
            }else if ($poids == 3){
                $max -=10 * $this->laps;
            }
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
    private function showRanking(){
        echo 'Grand prix de ' .$this->track. "<br \>";
        echo 'Classement général : <br \>';


        foreach ($this->ranking as $index => $rank) {
            if( $rank["failed"] === false) {
                echo '#' . ($index+1) . '-' .$rank["player"]->getUsername(). '<br \>';
            } else {
                echo $rank['player']->getUsername() . ' : abondon <br \>';
            }

        //    echo "# 1- Pseudo : " .$rank["player"]->getUsername(). "<br \>";
        //    echo "Pays : " .$rank["player"]->getCountry(). "<br \>";
        //    // echo $rank["player"]->getScore(). "<br \>";
        //   // echo $rank["player"]->getLevel(). "<br \>";
        //    echo "Véhicule : " .$rank["player"]->getVehicle()->getModel(). "<br \>";
        //    echo "Poids du véhicule : " .$rank["player"]->getVehicle()->getWeight(). "<br \>";
        //    echo "<br \>";
        }
        


    }





}
