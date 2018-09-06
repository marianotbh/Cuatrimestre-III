window.onload = $.ajax({
    type: "GET",
    url: "http://localhost:3000/notas",
    success: function (response) {
        callbackGetNotas(response);
    }
});

var callbackGetNotas = function (json) {
    tablify(json);
}

var callbackEdit = function (json) {
    console.log(json);
    if (json.type == "ok") {
        $.ajax({
            type: "GET",
            url: "http://localhost:3000/notas",
            success: function (response) {
                callbackGetNotas(response)
            }
        });
        $("#loadingGif").show();
        showEdit();
    } else if (json.type == "error") {
        error(json);
    }
}

var callbackEliminar = function (json) {
    console.log(json);
    if (json.type == "ok") {
        $.ajax({
            type: "GET",
            url: "http://localhost:3000/notas",
            success: function (response) {
                callbackGetNotas(response)
            }
        });
        $("#loadingGif").show();
    } else if (json.type == "error") {
        error(json);
    }
}

function tablify(arr) {
    var i;
    html = '';
    localStorage.setItem("items", JSON.stringify(arr));
    type = localStorage.getItem("type");
    for (i = 0; i < arr.length; i++) {
        obj = arr[i];
        if (obj.nota < 4) {
            html += "<tr style='color:red' align='center'>";
        } else if (obj.nota >= 4) {
            html += "<tr align='center'>";
        }
        html += '<td>' + obj.legajo + '</td><td>' + obj.nombre + '</td><td>' + obj.materia + '</td><td>' + obj.nota + '</td>';
        if (type == "Admin") {
            html += "<td><input type='button' value='Editar' onclick='showEdit(" + obj.id + ")'/></td>";
            html += "<td><input type='button' value='Eliminar' onclick='eliminar(" + obj.id + ")'/></td></tr>";
        } else if (type == "User") {
            html += "</tr>";
        }
    }
    $('#loadingGif').hide();
    $('#tbody').html(html);

}

function showEdit(id = null) {
    if ($("#editNota").css('display') == 'none') {
        $("#editNota").show();
        if (id != null) {
            items = JSON.parse(localStorage.getItem("items"));
            for (i = 0; i < items.length; i++) {
                if (items[i].id == id) {
                    $("#id").val(items[i].id);
                    $("#legajo").val(items[i].legajo);
                    $("#nombre").val(items[i].nombre);
                    $("#materia").val(items[i].materia);
                    $("#nota").val(items[i].nota);
                }
            }
        }
    }
    else if ($("#editNota").css('display') != 'none') {
        $("#editNota").hide();
    }
}

function edit() {
    var id = $("#id").val();
    var leg = $("#legajo").val();
    var nom = $("#nombre").val();
    var mat = $("#materia").val();
    var not = $("#nota").val();
    var datosPost = {
        id: id,
        legajo: leg,
        nombre: nom,
        materia: mat,
        nota: not
    }
    $.ajax({
        type: "POST",
        data: datosPost,
        url: "http://localhost:3000/editarNota",
        success: function (response) {
            callbackEdit(response);
        }
    })
    $("#loadingGif").show();
}

function eliminar(id) {
    var idjson = {
        id: id
    }
    $.ajax({
        type: "POST",
        data: idjson,
        url: "http://localhost:3000/eliminarNota",
        success: function (response) {
            callbackEliminar(response);
        }
    })
    $("#loadingGif").show();
}

function error(response) {
    $("#loadingGif").hide();
    $("#errWindow").show();
    $("#errWindow > h2").html(response.type);
    $("#errWindow > p").html(response.message);
}