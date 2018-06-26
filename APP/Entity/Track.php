<?php
namespace APP\Entity;

use APP\Game\Run;


class Track implements Entity {
    private $id;
    private $name;
    private $country;
    private static $db;

    public function getId(){
        return $this->id;
    }

    public function setId($id) {
        if(is_int($id) && $id > 0) {
            $this->id = $id;
        }
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
    public function __construct ($data) {
        $this->hydrate($data);
    }

    // hydratation
    public function hydrate($data) {
        foreach($data as $key => $value){
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    public static function prepare() {
        // antislash ou ajouter en haut use PDO
        self::$db = new \PDO('mysql:host=localhost;dbname=track', 'root', '');
    }

    public static function getRandom(){
        $query = self::$db->query('SELECT * FROM track ORDER BY RAND() LIMIT 1');
        $track = array();

        $data = $query->fetch(\PDO::FETCH_ASSOC);
        return new Track($data);

    }


}