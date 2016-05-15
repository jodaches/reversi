<?php
class Casilla{
    private $fila;
    private $columna;
    
    function __construct($fila,$columna){
        $this->fila=$fila;
        $this->columna=$columna;
    }
    
    public function getFila(){
        return $this->fila;
    }
    
    public function getColumna(){
        return $this->columna;
    }
}