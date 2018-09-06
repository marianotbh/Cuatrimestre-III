<?php
    echo "<h3>Aplicación Nº 24 (Operario - Fabrica)</h3>
    Métodos getters y setters (en Operario):
    GetSalario: Sólo retorna el salario del operario.
    Neiner, Maximiliano – Villegas, Octavio PHP- 2018 Página 6
    SetAumentarSalario: Sólo permite asignar un nuevo salario al operario. La asignación consiste en incrementar el salario de acuerdo al porcentaje que recibe como parámetro.
    Constructores: realizar los constructores para cada clase (Fabrica y Operario) con los parámetros que se detallan en la imagen.
    En la clase Fabrica, la cantidad máxima de operarios será inicializada en 5.
    Métodos (en Operario)
    GetNombreApellido (de instancia): Retorna un String que tiene concatenado el nombre y el apellido del operario separado por una coma.
    Mostrar (de instancia): Retorna un String con toda la información del operario. Utilizar el método GetNombreApellido.
    Mostrar (de clase): Recibe un operario y retorna un String con toda la información del mismo (utilizar el método Mostrar de instancia)
    Crear el método de instancia “Equals” que permita comparar al objeto actual con otro de tipo Operario. Retronará un booleano informando si el nombre, apellido y el legajo de los operarios coinciden al mismo tiempo.
    Métodos (en Fabrica)
    RetornarCostos (de instancia, privado): Retorna el dinero que la fábrica tiene que gastar en concepto de salario de todos sus operarios.
    MostrarOperarios (de instancia, privado): Recorre el Array de operarios de la fábrica y muestra el nombre, apellido y el salario de cada operario (utilizar el método Mostrar de operario).
    MostrarCosto (de clase): muestra la cantidad total del costo de la fábrica en concepto de salarios (utilizar el método RetornarCostos).
    Crear el método de clase “Equals”, recibe una Fabrica y un Operario. Retronará un booleano informando si el operario se encuentra en la fábrica o no. Reutilizar código.
    Add (de instancia): Agrega un operario al Array de tipo Operario, siempre y cuando haya lugar disponible en la fábrica y el operario no se encuentre ya ingresado. Reutilizar código. Retorna TRUE si pudo ingresar al operario, FALSE, caso contrario.
    Remove (de instancia): Recibe a un objeto de tipo Operario y lo saca de la fábrica, siempre y cuando el operario se encuentre en el Array de tipo Operario. Retorna TRUE si pudo quitar al operario, FALSE, caso contrario.
    Crear los objetos necesarios en testFabrica.php como para probar el buen funcionamiento de las clases. <br><br>";

    include_once("./Entidades/App24/testFabrica.php");

    TestFabrica();
?>