<?php
abstract class tableObject{
    abstract function __set($property, $value);
    abstract function __get(string $property);
    abstract function enumToString();
    abstract function insertSQL();
}
?>