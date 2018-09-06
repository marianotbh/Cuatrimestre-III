<?php
    include_once("./Entidades/App21/Auto.php");
    function TestAuto()
    {
        $autoDistintoColor1 = new Auto("Audi", "Rojo");
        $autoDistintoColor2 = new Auto("Audi", "Gris");
        $autoDistintoPrecio1 = new Auto("VW", "Negro", 128300);
        $autoDistintoPrecio2 = new Auto("VW", "Negro", 132000);
        $autoConFecha = new Auto("Toyota", "Gris", 124000, new DateTime('2011-01-01'));

        $autoDistintoPrecio1->AgregarImpuestos(1500);
        $autoDistintoPrecio2->AgregarImpuestos(1500);
        $autoConFecha->AgregarImpuestos(1500);

        echo "Importe sumado: ".Auto::Add($autoDistintoColor1, $autoDistintoColor2)."<br>";
        echo "Auto1 vs Auto2: ".$autoDistintoColor1->Equals($autoDistintoColor2)."<br>";
        echo "Auto1 vs Auto5: ".$autoDistintoColor1->Equals($autoConFecha)."<br>";

        echo $autoDistintoColor1->MostrarAuto();
        echo $autoDistintoPrecio1->MostrarAuto();
        echo $autoConFecha->MostrarAuto();
    }    
?>