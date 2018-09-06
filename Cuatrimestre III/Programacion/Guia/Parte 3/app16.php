<?php
    echo "<h3>Aplicación Nº 16 (Invertir palabra)</h3>
    Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden de las letras del Array.
    Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”. <br><br>";

    $arr = array('H','O','L','A',' ','M','U','N','D','O','!');
    echo "Array original: ".implode("",$arr)."<br>";
    echo "Array invertido: ".implode("",InvertirOrdenDeCaracteres($arr))."<br>";  

    function InvertirOrdenDeCaracteres($string)
    {

        $len = count($string);
        $aux = $string;
        for($i = 0, $j = $len-1; $i < $len; $i++, $j--)
        {
            $aux[$j] = $string[$i];
        }
        return $aux;
    }
?>