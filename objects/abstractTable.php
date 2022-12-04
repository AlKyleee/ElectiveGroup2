<?php
abstract class abstractTable{
    abstract function __set($property, $value);
    abstract function __get(string $property);
    abstract function insertSQL();
}
?>