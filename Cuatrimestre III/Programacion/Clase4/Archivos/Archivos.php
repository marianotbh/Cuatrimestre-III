<?php
    $ext = explode(".", $_FILES["Archivo"]["name"]);
    $nom = $_POST["Nombre"].".".$ext[1];
    if(move_uploaded_file($_FILES["Archivo"]["tmp_name"], "../img/$nom"))
        echo "<p>archivo movido con exito </p>";
?>

<br><br><a href="html.html">VOLVER</a>