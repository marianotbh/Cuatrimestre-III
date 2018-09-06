<?php
    echo "<h3>Aplicación Nº 15 (Potencias de números)</h3>
    Mostrar por pantalla las primeras 4 potencias de los números del uno 1 al 4 (hacer una función que las calcule invocando la función pow).<br><br>";

    for($i = 1; $i <= 4; $i++)
    {
        MostrarPrimeras4Potencias($i);
    }

    function MostrarPrimeras4Potencias($num)
    {   
        echo "<strong>".$num.": </strong>";
        for($i = 1; $i <= 4; $i++)
        {
            echo " ".pow($num,$i);
            if($i == 4)
                echo ".";
            else
                echo ",";
        }
        echo "<br>";
    }
?>