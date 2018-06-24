<?php
require_once( 'Vehicle.php' );
// require_once 'Vehicle.php';
require_once( 'Player.php' );
require_once( 'Run.php' );

// création des véhicules
$bmw = new Vehicle('Phantom ', 'Framboise', 1, 2);
$mercedes = new Vehicle('Monster 5', 'Gris', 6, 3);
$batmobile = new Vehicle('Batmobile 3000', 'Noir', 2, 4 );
$venger = new Vehicle('Venger GT', 'Bleu', 1, 12 );

// création des jouers
$messi = new Player('Rambo', 'us', $mercedes);
$ronaldo = new Player('Killer', 'fr', $bmw );
$bruce = new Player('Batman', 'uk', $batmobile );
$paul = new Player('Marcel', 'be', $venger );

// création de la course
$run1 = new Run('Monza');

// ajouter les joueurs
$run1->addPlayer($messi);
$run1->addPlayer($ronaldo);
$run1->addPlayer($bruce);
$run1->addPlayer($paul);

//var_dump($run1);

$run1->simulate();