
<body>
    <form action="Accion.php" method="post" enctype="multipart/form-data">
        <label>Nombre</label>
        <input type='text' name='nombre' value="Pepito"><br>
        <label>Apellido</label>
        <input type='text' name='apellido' value="Johnson"><br>
        <label>DNI</label>
        <input type='text' name='dni' value="3838383"><br>
        <label>Legajo</label>
        <input type='text' name='legajo' value="111111"><br>
        <label>Foto</label>
        <input type="file" name='foto'>
        <br><br>
        <input type='submit' name='btn' value='Cargar'>
        <input type='submit' name='btn' value='Modificar'>
        <input type='submit' name='btn' value='Borrar'>
    </form>
</body>

<?php
    /*  
    w = escritura
    r = lectura
    a = agregar
    x = eeeeee
    */
    /*
    $ref = fopen("Archivo.txt", "w");
    echo "Escribió ".fwrite($ref, "Contenido" , "opcional: cant de bytes")." bytes. <br>";
    fclose($ref);

    $ref = fopen("Archivo.txt", "w"); //sobreescribe el archivo
    echo "Escribió ".fwrite($ref, ":O".PHP_EOL , "opcional: cant de bytes")." bytes. <br>";
    fclose($ref);

    $ref = fopen("Archivo.txt", "a"); //agrega al archivo
    echo "Escribió ".fwrite($ref, "Agregato" , "opcional: cant de bytes")." bytes. <br>";
    fclose($ref);

    copy("Archivo.txt", "Copia.txt"); // copia ("origen", "destino")
    unlink("Archivo.txt"); //elimina el archivo.

    echo "<br>";
    */
    // $ref = fopen("Lista.txt", "w");

    // include_once("../Entidades/Persona.php");

    // fwrite($ref, "Mariano-Burgos-22-2342123".PHP_EOL);
    // fwrite($ref, "Mauricio-Cerizza-15-1112321".PHP_EOL);
    // fwrite($ref, "Marina-Cardozo-20-5433111".PHP_EOL);
    // fwrite($ref, PHP_EOL);
    // fwrite($ref, "Demian-Demianez-30-1233412".PHP_EOL);
    // $p1 = new Persona("Pepo", "Jones", 34, 123456);
    // fwrite($ref, "$p1");
    // rewind($ref);  //vuelve al principio del archivo

    // fclose($ref);
?>