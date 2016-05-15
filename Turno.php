<?php
class Turno{
    private $EstadoActual = array();
    private $EquipoActual;
    private $EquipoEnemigo;
    private $cantidadJugadas;
    
    function __construct($turno,$estado){ //turno 0 negras, 1 blancas
        $this->EquipoActual=(int)$turno;
        $this->EquipoEnemigo= (int)!$turno;
        $estadoarray= str_split($estado);
        for($fila=0;$fila<8;$fila++){
            for($columna=0;$columna<8;$columna++){
                $this->EstadoActual[$fila][$columna]=intval($estadoarray[$fila*8+$columna]);
            }
        }
        
    }
    
    public function getEstadoActual(){
        return $this->EstadoActual;
    }
    
    public function getEquipoActual(){
        return $this->EquipoActual;
    }
    
    public function getEquipoEnemigo(){
        return $this->EquipoEnemigo;
    }
    
    
    
    public function escogerJugada($jugadas){
        $prioridades= ["X","C","X2","C2","B2","A2","B","A","esquina"];
        $mejores = array();
        $decidido=false;
        $mejor= new Jugada(0,0,"");
        while(!$decidido){
            $categoria=array_pop($prioridades);
            foreach($jugadas as $j){
                if($j->getCategoria()==$categoria){
                    array_push($mejores,$j);
                    $decidido=true;
                }
            }
            foreach($mejores as $o){
                if($o->getCantidadConvertidas()>$mejor->getCantidadConvertidas()){
                    $mejor=$o;
                }
            }
            
        }
        return $mejor->getFila().$mejor->getColumna();
    }
    
    private function puntuarJugada($jugada){
        
    }
}