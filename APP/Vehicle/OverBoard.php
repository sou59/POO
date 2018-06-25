<?php

namespace APP\Vehicle;

class OverBoard extends Vehicle {
    private $size;
    private $brand;
    
    
    public function __constr($brand, $color) {
        $this->brand = $brand;
    }
    public function powerUp() {
        echo "Choucroute du soleil<br\>";

    }

}