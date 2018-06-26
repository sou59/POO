<?php
namespace APP\Entity;

interface Entity {
    public function getId();

    public function setId($id);

    public function __construct ($data);

    // hydratation
    public function hydrate($data);

    public static function prepare();

}