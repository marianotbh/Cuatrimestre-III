<?php
    include_once("./Entidades/App22/Garage.php");
    function TestGarage()
    {
        $auto1 = new Auto("Audi", "Rojo");
        $auto2 = new Auto("Audi", "Gris");
        $auto3 = new Auto("VW", "Negro", 128300);
        $auto4 = new Auto("VW", "Negro", 132000);
        $auto5 = new Auto("Toyota", "Gris", 124000, new DateTime('2011-01-01'));

        $garage = new Garage("Estacionamiento", 13.50);

        $garage->Add($auto1);
        $garage->Add($auto2);
        $garage->Add($auto3);
        $garage->Add($auto4);
        $garage->Add($auto5);

        $garage->MostrarGarage();
    }
?>