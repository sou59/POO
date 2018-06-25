<?php

// AU lieu d'appeler chaque class on utilise les namespaces et la fcontion d'autoload
// Vehicle à mettre en premier
// require_once( 'Vehicle.php' );
// require_once( 'Cycle.php' );
// require_once( 'OverBoard.php' );
// require_once( 'Car.php' );
// require_once( 'Player.php' );
// require_once( 'Run.php' );

require_once('APP/Autoloader.php');
// APP\Autoloader::register();
use APP\Autoloader;
Autoloader::register();

use APP\Vehicle\Vehicle;
use APP\Vehicle\Car;
use APP\Vehicle\OverBoard;
use APP\Vehicle\Cycle;
use APP\Game\Player;
use APP\Game\Run;


// création des véhicules
$bmw = new Car('Phantom ', 'Framboise', 1, Vehicle::LOW_WEIGHT);
$mercedes = new Car('Monster 5', 'Gris', 6, Vehicle::MEDIUM_WEIGHT);
$batmobile = new Cycle('Batmobile 3000', 'Noir', 2, Vehicle::LOW_WEIGHT );
$venger = new Overboard('Venger GT', 'Bleu', 1, Vehicle::HEAVY_WEIGHT );

// création des jouers
$messi = new Player('Rambo', 'us', $mercedes);
$ronaldo = new Player('Killer', 'fr', $bmw );
$bruce = new Player('Batman', 'uk', $batmobile );
$paul = new Player('Marcel', 'be', $venger );
// création des jouers non inscrits
$falbala = new Player('Falba', 'us', $mercedes);
$kante = new Player('Kante', 'fr', $bmw );
$pixel = new Player('REM', 'uk', $batmobile );
$lukaku = new Player('Luka', 'be', $venger );

// création de la course 1
$run1 = Run::generateRun();
// ajouter les joueurs
$run1->addPlayer($messi);
$run1->addPlayer($ronaldo);
$run1->addPlayer($bruce);
$run1->addPlayer($paul);
$run1->addPlayer($falbala);
$run1->addPlayer($kante);
//var_dump($run1);
$run1->simulate();

// création de la course 2

//$run2 = new Run('Indianapolis');
// remplacer par : 
$run2 = Run::generateRun();
// ajouter les joueurs
$run2->addPlayer($messi);
$run2->addPlayer($ronaldo);
$run2->addPlayer($pixel);
$run2->addPlayer($lukaku);
//var_dump($run1);
$run2->simulate();

