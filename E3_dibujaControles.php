<?php

//lista de los controles en filas y hasta tres columnas
$listaControles = [['on', 'off'],
    ['1', '2', '3'],
    ['4', '5', '6'],
    ['7', '8', '9'],
    ['C+', 'C-'],
    ['V+', 'M', 'V-']];

//variable que va a contener el html con la botonera
$mando = "<table  border=1>";

//como siempre recorremos cada $fila
for ($fila = 0; $fila < count($listaControles); $fila++) {
    
    //abrimos fila <tr>
    $mando .= "<tr>";
    
    //para cada columna
    for ($columna = 0; $columna < count($listaControles[$fila]); $columna++) {
        
        //colocamos en la celda <td> el boton
        $mando .= '<td> <input type="submit" name="boton"'
                . 'value='.$listaControles[$fila][$columna] . '></td>';
        
    }
    
    //cerramos fila
    $mando .= "</tr>";
}
//cerramos tabla
$mando .= "</table>";

//mostramos el $mando
echo $mando;

