<?php
    echo "<h3>Aplicación Nº 22 (Auto - Garage)</h3>2
        Crear la clase Garage que posea como atributos privados:  <br>
        _razonSocial (String)  <br>
        _precioPorHora (Double) <br>
        _autos (Autos[], reutilizar la clase Auto del ejercicio anterior) <br>
        Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros: <br>
        i. La razón social. <br>
        ii. La razón social, y el precio por hora. <br>
        Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y que mostrará todos los atributos del objeto. <br>
        Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje. <br>
        Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage” (sólo si el auto no está en el garaje, de lo contrario informarlo). <br>
        Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del “Garage” (sólo si el auto está en el garaje, de lo contrario informarlo). <br>
        En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los métodos.<br><br>";
    
    include_once("./Entidades/App22/testGarage.php");

    TestGarage();

?>