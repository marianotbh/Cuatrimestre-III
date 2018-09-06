<?php
    include("./Entidades/Persona.php");
    include("./Entidades/Direccion.php");
    include("./Entidades/Localidad.php");
    include("./Entidades/Alumno.php");
    include("./Entidades/Profesor.php");

    echo "<head><style>body {background-color:aquamarine;font-size:20px;font-family:Helvetica}h1,h2,h3,h4,h5,h6 {margin:0;padding:0;line-height:1.5em}</style></head>";

    $materias = array("Programacion", "Laboratorio");
    $dias = array("Lun", "Mie", "Vie");

    $localidad = new Localidad("1832", "Localidad");
    $direccion = new Direccion("Calle", "1130", $localidad);
    $alumno = new Alumno("Juanito", "Lopez", 33344433, $direccion, "44432", "4/3/18");

    $localidad2 = new Localidad("1134", "Otra localidad");
    $direccion2 = new Direccion("OtraCalle", "1230", $localidad2);
    $profe = new Profesor("Profesor", "Girafales", 33443344, $direccion2, $materias, $dias);

    echo $alumno;
    echo $profe;

?>