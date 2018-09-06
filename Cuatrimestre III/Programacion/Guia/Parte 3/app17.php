<?php
    echo @"<h3>Aplicación Nº 17 (Validar palabra)</h3>
    Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). <br>
    La función validará que la cantidad de caracteres que tiene $palabra no supere a $max <br>
    y además deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:<br>
     “Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán:<br>
    1 si la palabra pertenece a algún elemento del listado. 0 en caso contrario.<br><br>";

    echo "<strong>Palabra supera el valor max: </strong>".validarPalabra("Palabra",5)."<br>";
    echo "<strong>Palabra no está en la lista de palabras válidas: </strong> ".validarPalabra("Palabra", 10)."<br>";
    echo "<strong>Palabra está en la lista de palabras válidas: </strong> ".validarPalabra("Programacion", 20)."<br>";

    function validarPalabra($palabra, $max)
    {
        $listadoDePalabrasValidas = array("Recuperatorio", "Parcial", "Programacion");
        if(strlen($palabra) <= $max)
        {
            foreach($listadoDePalabrasValidas as $PalabraValida)
            {
                if($palabra == $PalabraValida)
                    return 1;
            }
            return 0;
        }
        else
            return "(!!!) La cantidad de caracteres que tiene la palabra '$palabra' supera al máximo ($max) perimitido.";
    }
?>