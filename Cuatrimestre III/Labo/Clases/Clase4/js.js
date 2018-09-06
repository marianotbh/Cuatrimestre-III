var httpReq = new XMLHttpRequest(); //objeto servidor
var callback = function () {
    if (httpReq.readyState === 4) {
        if (httpReq.status === 200) {
            document.getElementById("loadingGif").className = "hide";
            document.getElementById("formulario").className = "show";
            console.log(httpReq.responseText);
            if (httpReq.responseText == "false") {
                document.getElementById("lblErr").className = "show";
                document.getElementById("txtUSR").className = "err";
                document.getElementById("txtPW").className = "err";
            }
            else if (httpReq.responseText == "true") { 
                document.getElementById("lblErr").className = "hide";
                document.getElementById("txtUSR").className = "";
                document.getElementById("txtPW").className = "";
            }
        } else {
            alert("Error de servidor: " + httpReq.status);
        }
    }
};
function ajax(metodo, url, parametros) {
    httpReq.onreadystatechange = callback;
    if (metodo === "GET") {
        httpReq.open(metodo, url + parametros, true); //abre la conexion
        httpReq.send();
    }
    else if (metodo === "POST") {
        httpReq.open(metodo, url, true); //abre la conexion
        httpReq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        httpReq.send(parametros);
    }
}
function enviar(metodo) {
    document.getElementById("loadingGif").className = "show";
    document.getElementById("formulario").className = "hide";
    paramUser = "usr=" + document.getElementById("txtUSR").value;
    paramPass = "pass=" + document.getElementById("txtPW").value;
    if (metodo === "GET")
        ajax("GET", "http://localhost:3000/loginUsuario?", paramUser + "&" + paramPass);
    else if (metodo === "POST")
        ajax("POST", "http://localhost:3000/loginUsuario/", paramUser + "&" + paramPass);
}

