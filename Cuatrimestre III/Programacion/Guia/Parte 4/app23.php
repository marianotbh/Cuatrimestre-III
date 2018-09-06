<?php
    echo "<h3>Aplicación Nº 23 (Pasajero - Vuelo) </h3>
    Dadas las siguientes clases: <br>
    Pasajero <br>
    Atributos privados: _apellido (string), _nombre (string), _dni (string), _esPlus (boolean) <br>
    Crear un constructor capaz de recibir los cuatro parámetros. <br>
    Crear el método de instancia “Equals” que permita comparar dos objetos Pasajero. Retornará TRUE cuando los _dni sean iguales. <br>
    Agregar un método getter llamado GetInfoPasajero, que retornará una cadena de caracteres con los atributos concatenados del objeto. <br>
    Agregar un método de clase llamado MostrarPasajero que mostrará los atributos en la página. <br>
    Vuelo <br>
    Atributos privados: _fecha (DateTime), _empresa (string) _precio (double), _listaDePasajeros (array de tipo Pasajero), <br>
     _cantMaxima (int; con su getter). Tanto _listaDePasajero como _cantMaxima sólo se inicializarán en el constructor. <br>
    Crear el constructor capaz de que de poder instanciar objetos pasándole como parámetros: <br>
    i. La empresa y el precio. <br>
    ii. La empresa, el precio y la cantidad máxima de pasajeros. <br>
    Agregar un método getter, que devuelva en una cadena de caracteres toda la información de un vuelo: fecha, empresa, precio, <br>
     cantidad máxima de pasajeros, <br> y toda la información de todos los pasajeros.
    Crear un método de instancia llamado AgregarPasajero, en el caso que no exista en la lista,  <br>
    se agregará (utilizar Equals). Además tener en cuenta la capacidad del vuelo. El valor de retorno de este método indicará si se agregó o no. <br>
    Agregar un método de instancia llamado MostrarVuelo, que mostrará la información de un vuelo. <br>
    Crear el método de clase “Add” para que permita sumar dos vuelos. El valor devuelto deberá ser de tipo numérico, <br>
    y representará el valor recaudado por los vuelos. Tener en cuenta que si un pasajero es Plus, se le hará un descuento del 20% en el precio del vuelo. <br>
    Crear el método de clase “Remove”, que permite quitar un pasajero de un vuelo, siempre y cuando el pasajero esté en dicho vuelo, caso contrario, informarlo. <br>
    El método retornará un objeto de tipo Vuelo.<br><br>";

    include("./Entidades/App23/testVuelo.php");

    TestVuelo();
?>