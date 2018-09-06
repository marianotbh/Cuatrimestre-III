<?php
    echo "<h3>Aplicación Nº 21 (Auto)</h3>
        
        En testAuto.php: 
        <br> Crear dos objetos “Auto” de la misma marca y distinto color.
        <br> Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
        <br> Crear un objeto “Auto” utilizando la sobrecarga restante.
        <br> Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500 al atributo precio.
        <br> Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el resultado obtenido.
        <br> Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.
        <br> Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5) <br><br>";

    include_once("./Entidades/App21/testAuto.php");

    TestAuto();
?>