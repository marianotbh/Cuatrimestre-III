<?php
    include("./Entidades/App23/Vuelo.php");
    function TestVuelo()
    {
        $p1 = new Pasajero("Burgos", "Mariano", "38785716", TRUE);
        $p2 = new Pasajero("Benitez", "Lorenzo", "38785716", FALSE);
        $p3 = new Pasajero("Lopez", "Ana", "38785717", FALSE);
        $p4 = new Pasajero("Rodriguez", "Andrea", "38285716", FALSE);
        $p5 = new Pasajero("Blanco", "Lucas", "38784716", TRUE);

        $v1 = new Vuelo("LAN", 15000, new DateTime('2011-01-01'), 2);
        $v2 = new Vuelo("Aerolineas Argentinas", 13500, new DateTime('2011-01-01'), 5);

        $v1->AgregarPasajero($p1);
        $v1->AgregarPasajero($p2);
        $v1->AgregarPasajero($p3);
        $v1->AgregarPasajero($p4);
        $v1->AgregarPasajero($p5);
        
        $v2->AgregarPasajero($p1);
        $v2->AgregarPasajero($p2);
        $v2->AgregarPasajero($p3);
        $v2->AgregarPasajero($p4);
        $v2->AgregarPasajero($p5);

        $v1->MostrarVuelo();
        $v2->MostrarVuelo();
    }
?>