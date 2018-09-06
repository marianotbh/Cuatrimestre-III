var callbackLogin = function (json) {
    if (json != null && (json.type == "Admin" || json.type == "User")) {
        localStorage.setItem("type", json.type);
        window.location.href = "../html/index.html";
    } else if (json != null && json.type == "error") {
        err();
        $("#loadingGif").hide();
    }
}

function login() {
    var correo = $("#correo").val();
    var pw = $("#pw").val();
    localStorage.setItem("email", correo);
    var datosLogin = { email: correo, password: pw };
    $.ajax({
        type: "POST",
        data: datosLogin,
        url: "http://localhost:3000/login",
        success: function (response) {
            callbackLogin(response)
        }
    });
    $("#loadingGif").show();
}

function err() {
    $("#correo").addClass("err");
    $("#pw").addClass("err");
    $("#errMsg").html("Correo o contraseña incorrectos");
}