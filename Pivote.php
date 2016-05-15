<?php
include "Casilla.php";

class Pivote extends Casilla{
    private $posibilidades = array();
    
    private function agregarPosibilidad($PosibleJugada){
        array_push($this->posibilidades,$PosibleJugada);
    }
    
    public function obtenerMejor($Matriz){
        return "la mejor posibilidad";
    }
    
    public function getPosibilidades(){
        return $this->posibilidades;
    }
    
    public function calcularPosibilidades(){
        $mat=Reversi::$Matriz;
        $f=$this->getFila();
        $c=$this->getColumna();
        if($mat[$f][$c+1]==2)//a la derecha
            $this->agregarPosibilidad(new Jugada($f,$c+1,"l"));
        if($mat[$f][$c-1]==2)//a la izquierda
            $this->agregarPosibilidad(new Jugada($f,$c-1,"r"));
        if($mat[$f+1][$c]==2)//abajo
            $this->agregarPosibilidad(new Jugada($f+1,$c,"u"));
        if($mat[$f-1][$c]==2)//arriba
            $this->agregarPosibilidad(new Jugada($f-1,$c,"d"));
        if($mat[$f+1][$c+1]==2)//abajo derecha
            $this->agregarPosibilidad(new Jugada($f+1,$c+1,"ul"));
        if($mat[$f+1][$c-1]==2)//abajo izquierda
            $this->agregarPosibilidad(new Jugada($f+1,$c-1,"ur")); //up right
        if($mat[$f-1][$c+1]==2)//arriba derecha
            $this->agregarPosibilidad(new Jugada($f-1,$c+1,"dl")); //down left
        if($mat[$f-1][$c-1]==2)//arriba izquierda
            $this->agregarPosibilidad(new Jugada($f-1,$c-1,"dr")); //down right
        return count($this->posibilidades);
    }
}