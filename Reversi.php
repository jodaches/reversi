<?php
include "Turno.php";
include "Pivote.php";
include "Jugada.php";

class Reversi{
    static $Matriz;
}
//definicion de variables
$pivotes=array();
$jugadas=array();


//mapear tablero y turno
$turno = new Turno($_GET['turno'],$_GET['estado']);
Reversi::$Matriz=$turno->getEstadoActual();

//evaluar posiciones enemigas con posibilidades para pivotear
for($fila=0;$fila<8;$fila++){
    $columnas= array_keys(Reversi::$Matriz[$fila],$turno->getEquipoEnemigo());//enemigos por fila
    foreach ($columnas as $col){
        $pivote = new Pivote($fila,$col);
        if($pivote->calcularPosibilidades()>=1){
            array_push($pivotes,$pivote);   
        }
    }
}

//confirmar cuales de las posibles jugadas, sí son jugadas
foreach($pivotes as $piv){
    foreach($piv->getPosibilidades() as $pos){
        if($pos->evaluar($turno->getEquipoActual()))
            array_push($jugadas, $pos);   
    }
    //echo "Piv: ".$piv->getFila().$piv->getColumna()."<br>";
}

//tomar la desicion
if(count($jugadas)>0){
    echo $turno->escogerJugada($jugadas);
}

//la primera para ver si funciona lo demas
//echo $jugadas[0]->getFila().$jugadas[0]->getColumna();
?>