<?php
    echo "<h3>Aplicación Nº 18 (Par e impar)</h3>
    Crear una función llamada EsPar que reciba un valor entero como parámetro y devuelva TRUE si este número es par ó FALSE si es impar. <br>
    Reutilizando el código anterior, crear la función EsImpar.<br><br>";

    $num = 5;

    echo "$num es par: ".EsPar($num)."<br>";
    echo "$num es impar: ".EsImpar($num)."<br>";

    function EsPar($num)
    {
        if($num % 2 == 0)
            return TRUE;
        else
            return FALSE;
    }

    function EsImpar($num)
    {
        return !EsPar($num);
    }
?>