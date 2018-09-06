<?php
    echo "<h3>Aplicación Nº 19 (Figuras geométricas)</h3>
    La clase FiguraGeometrica posee: todos sus atributos protegidos, un constructor por defecto,  <br>
    un método getter y setter para el atributo _color, un método virtual (ToString) y dos métodos abstractos:  <br>
    Dibujar (público) y CalcularDatos (protegido).<br>
    CalcularDatos será invocado en el constructor de la clase derivada que corresponda, <br>
    su funcionalidad será la de inicializar los atributos _superficie y _perimetro. <br>
    Dibujar, retornará un string (con el color que corresponda) formando la figura geométrica del  <br>
    objeto que lo invoque (retornar una serie de asteriscos que modele el objeto). <br><br>";

    include_once("./Entidades/App19/Rectangulo.php");
    include_once("./Entidades/App19/Triangulo.php");
    
    $triang = new Triangulo(5,7);
    $rectang = new Rectangulo(15,8);
    
    $triang->SetColor("Red");
    $rectang->SetColor("Yellow");

    echo $triang->ToString();
    echo $rectang->ToString();
?>