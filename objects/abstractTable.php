<?php
abstract class abstractTable{
    function __construct(){}
    abstract function __set($property, $value);
    abstract function __get(string $property);
    abstract function insertSQL();
}
?>