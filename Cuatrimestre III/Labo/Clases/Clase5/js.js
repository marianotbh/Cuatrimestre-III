function $(id) {
    return document.getElementById(id);
}
var httpReq = new XMLHttpRequest();
var url = "http://localhost:3000/personas";
var personas;

function getPersonas() {
    httpReq.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            personas = localStorage.setItem("personas", JSON.stringify(personas));
            if (personas == null || personas == undefined) {
                personas = JSON.parse(this.responseText);
                tablify(personas);
            }
        }
    };
}

httpReq.open("GET", url, true);
httpReq.send();

function tablify(arr) {
    var i;
    for (i = 0; i < arr.length; i++) {
        obj = arr[i];
        $("tbody").innerHTML += "<tr align='center'><td>" + obj.nombre + "</td><td>" + obj.apellido + "</td><td>" + obj.fecha + "</td><td>" + obj.telefono + "</td><td><a onclick='borrarPersona(" + i + ")' href='#'>Borrar</a></td></tr>";
    }
}

function guardarPersona() {
    var nombre = $("txtNombre").value;
    var apellido = $("txtApellido").value;
    var fecha = $("fecha").value;
    var telefono = $("telefono").value;
    var str = '{"nombre":"' + nombre + '", "apellido":"' + apellido + '","fecha":"' + fecha + '","telefono":"' + telefono + '"}';
    var persona = JSON.parse(str);
    personas.push(persona);
    personas = localStorage.setItem("personas", JSON.stringify(personas));
    tablify(personas);
}

function borrarPersona(index) {
    personas.splice(index,1);
    personas = localStorage.setItem("personas", JSON.stringify(personas));
    tablify(personas);
}

function displayForm() {
    if ($("formulario").className == "hidden")
        $("formulario").className = "shown";
    else
        $("formulario").className = "hidden";
}

window.onload = getPersonas();