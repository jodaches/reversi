<?php
class Jugada extends Casilla{
    private $direccion;
    private $cantidadConvertidas=0;
    private $categoria;
    private $punteo=0;
    
    
    function __construct($f,$c,$d){
        parent::__construct($f,$c);
        $this->direccion=$d;
    }
    
    public function setCategoria($categoria){
        $this->categoria=$categoria;
    }
    
    public function getCategoria(){
        return $this->categoria;
    }
    
    public function getPunteo(){
        return $this->punteo;
    }
    public function setPunteo($punteo){
        $this->punteo=$punteo;
    }
    
    public function getCantidadConvertidas(){
        return $this->cantidadConvertidas;
    }
    
    public function evaluar($team){
        $this->categorizar();
        $m=Reversi::$Matriz;
        $f=$this->getFila();
        $c=$this->getColumna();
        switch ($this->direccion) {
            case 'u':
                do{
                    $f--;
                    if($m[$f][$c]==$team)
                        return true;
                    $this->cantidadConvertidas++;    
                }while($f>0 && $m[$f][$c]!=2);
                break;
            case 'd':
                do{
                    $f++;
                    if($m[$f][$c]==$team)
                        return true;
                    $this->cantidadConvertidas++;
                }while($f<7 && $m[$f][$c]!=2);
                break;
            case 'l':
                do{
                    $c--;
                    if($m[$f][$c]==$team)
                        return true;
                    $this->cantidadConvertidas++;
                }while($c>0 && $m[$f][$c]!=2);
                break;
            case 'r':
                do{
                    $c++;
                    if($m[$f][$c]==$team)
                        return true;
                    $this->cantidadConvertidas++;
                }while($c<7 && $m[$f][$c]!=2);
                break;
            case 'ul':
                do{
                    $f--;
                    $c--;
                    if($m[$f][$c]==$team)
                        return true;
                    $this->cantidadConvertidas++;
                }while($f>0 && $c>0 && $m[$f][$c]!=2);
                break;
            case 'ur':
                do{
                    $f--;
                    $c++;
                    if($m[$f][$c]==$team)
                        return true;
                    $this->cantidadConvertidas++;
                }while($f>0 && $c<7 && $m[$f][$c]!=2);
                break;
            case 'dl':
                do{
                    $f++;
                    $c--;
                    if($m[$f][$c]==$team)
                        return true;
                    $this->cantidadConvertidas++;
                }while($f<7 && $c>0 && $m[$f][$c]!=2);
                break;
            case 'dr':
                do{
                    $f++;
                    $c++;
                    if($m[$f][$c]==$team)
                        return true;
                    $this->cantidadConvertidas++;
                }while($f<7 && $c<7 && $m[$f][$c]!=2);
                break;
            default:
                return false;
        }
        return false;
    }
    
    private function categorizar(){
        $esquinas=["--","00","77","07","70"];
        $A=["--","02","05","20","27","50","57","72","75"];
        $B=["--","03","04","30","37","40","47","73","74"];
        $C=["--","01","06","10","17","60","67","71","76"];
        $X=["--","11","16","61","66"];
        
        $A2=["--","22","25","52","55"];
        $B2=["--","32","42","23","24","35","45","53","54"];
        $C2=["--","21","12","15","26","51","62","65","56"];
        $X2=["--","31","41","13","14","36","46","63","64"];
        
        $casilla= $this->getFila().$this->getColumna();
        
        if(array_search($casilla,$esquinas)!=false)
            $this->categoria="esquina";
        elseif(array_search($casilla,$A)!=false)
            $this->categoria="A";
        elseif(array_search($casilla,$B)!=false)
            $this->categoria="B";
        elseif(array_search($casilla,$A2)!=false)
            $this->categoria="A2";
        elseif(array_search($casilla,$B2)!=false)
            $this->categoria="B2";
        elseif(array_search($casilla,$C2)!=false)
            $this->categoria="C2";
        elseif(array_search($casilla,$X2)!=false)
            $this->categoria="X2";
        elseif(array_search($casilla,$C)!=false)
            $this->categoria="C";
        elseif(array_search($casilla,$X)!=false)
            $this->categoria="X";
    }
}