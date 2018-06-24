<?php
class Vehicle {

    // le moteur, sa position est etteinte par défaut
    private $engine = false;
    private $speed = 0;
    // roues
    private $wheels;
    private $color;
    // poids
    private $weight;
    private $model;

    public function __construct($model, $color, $wheels, $weight){
        $this->model = $model;
        // utiliser le setter quand il existe cela evite de réécrire 2 fois la même chose et ainsi de faire des modifs qu'à un seul endroit dans le set
        $this->setColor($color);
        $this->wheels = $wheels;
        $this->setWeight($weight);
        
    }
    private function setWeight($weight) {
        if(is_int($weight)){
            $this->weight = $weight;
        }
    }

    public function start() {
        $this->engine = true;
    }

    public function speedUp(){
        $this->speed++;
    }
    public function brake(){
        if($this<= 0 ){
            return;
        }
        $this->speed--;
    }
    // direction angle en fonction d'un négatif ou d'un positif
    public function turn($radius){
        // ... manque les notions d'espace
    }

    // aller en arrière
    public function reverse(){
        $this->speed = -1;
    }

    // arrêter
    public function stop(){
        $this->engine = false;
    }
// getter à écrire avec get et le nom de l'attribut récupère la valeur de l'attibut
    public function getSpeed(){
        return $this->speed;
    }
// avec set on modifie l'attribut de départ
// il écrase la valeur de départ
    public function setColor( $color ){
        $this->color = $color;

    }

    public function getWeight() {
        return $this->weight;

    }
    public function getModel() {
        return $this->model;

    }

}


