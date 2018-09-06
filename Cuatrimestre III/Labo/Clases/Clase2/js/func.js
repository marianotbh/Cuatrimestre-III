function $(id) {
    return document.getElementById(id);
}

function sumar()
{
    var res;
    var n1 = parseInt($("n1").value);
    var n2 = parseInt($("n2").value);
    if(!isNaN(n1) && !isNaN(n2))
    {
        $("txtResultado").value =  n1 + n2;
        res = $("txtResultado").value;
        $("consig").innerHTML = "La suma se ha realizado";  
    }
    else
        alert("Complete todos los campos");
    return res;
}

function sumarYGuardar()
{
    var res = sumar();
    if(res != undefined)
        $("tbdy").innerHTML += "<tr align='center'><td>" + $("n1").value + "</td><td>" + $("n2").value + "</td><td>" + res + "</td></tr>";
}

function limpiar()
{
    $("n1").value = "";
    $("n2").value = "";
    $("txtResultado").value = "";
    $("consig").innerHTML = "Se debe ingresar dos números y hacer click en el botón sumar para ver el resultado";
}