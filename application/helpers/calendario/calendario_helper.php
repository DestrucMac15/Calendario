<?php 

function buscarValorEnArrayMultidimensional($array, $desarrollo, $fecha) {

    foreach($array['data'] as $clave => $valor){

        if($valor['Desarrollos.id'] === $desarrollo && $valor['Fecha'] === $fecha){

            return $clave;

        }

    }

}