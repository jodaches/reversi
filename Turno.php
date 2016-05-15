<?php
class Turno{
    private $EstadoActual = array();
    private $EquipoActual;
    private $EquipoEnemigo;
    private $jugadas=array();
    private $pivotes=array();
    
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
    
    
    public function setEstadoActual($matriz){
        $this->EstadoActual=$matriz;
    }
    
    public function setTeams($turno){
        $this->EquipoActual=(int)$turno;
        $this->EquipoEnemigo= (int)!$turno;
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
    public function getJugadas(){
        return $this->jugadas;
    }
    
    
    
    public function escogerJugada(){
        $prioridades= ["X","C","X2","C2","B2","A2","B","A","esquina"];
        $mejores = array();
        $decidido=false;
        $mejor= new Jugada(0,0,"");
        /*while(!$decidido){
            $categoria=array_pop($prioridades);
            foreach($this->jugadas as $j){
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
            
        }*/
        foreach($this->jugadas as $j){
            $j->puntuar($this);
            $retador=$j->getPunteoFinal();
            $campeon=$mejor->getPunteoFinal();
            if($retador>$campeon){
                $mejor=$j;
            }
        }
        return $mejor->getFila().$mejor->getColumna();
    }
    
    
    
    public function identificarPivotes(){
        for($fila=0;$fila<8;$fila++){
            $columnas= array_keys($this->getEstadoActual()[$fila],$this->getEquipoEnemigo());//enemigos por fila
            foreach ($columnas as $col){
                $pivote = new Pivote($fila,$col);
                if($pivote->calcularPosibilidades()>=1){
                    array_push($this->pivotes,$pivote);   
                }
            }
        }
    }
    
    public function identificarJugadas(){
        foreach($this->pivotes as $piv){
            foreach($piv->getPosibilidades() as $pos){
                if($pos->evaluar($this->getEquipoActual()))
                    array_push($this->jugadas, $pos);   
            }
        }
    }
}