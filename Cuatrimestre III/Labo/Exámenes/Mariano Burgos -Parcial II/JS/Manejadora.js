var SP;
(function (SP) {
    var Manejadora = /** @class */ (function () {
        function Manejadora() {
        }
        Manejadora.LoadForm = function (id) {
            for (var i = 0; i < this.listaEmpleados.length; i++) {
                var empleado = this.listaEmpleados[i];
                if (empleado.getLegajo() === id) {
                    $("#legajo").val(empleado.getLegajo());
                    $("#nombre").val(empleado.getNombre());
                    $("#apellido").val(empleado.getApellido());
                    $("#edad").val(empleado.getEdad());
                    $("#horario").val(empleado.getHorario());
                    break;
                }
            }
        };
        Manejadora.agregarEmpleado = function () {
            var nombre = String($("#nombre").val());
            var apellido = String($("#apellido").val());
            var edad = Number($("#edad").val());
            var horario = String($("#horario").val());
            var legajo = Number($("#legajo").val());
            var empleado = new SP.Empleado(nombre, apellido, edad, legajo, horario);
            this.listaEmpleados.push(empleado);
            localStorage.setItem("empleados", JSON.stringify(this.listaEmpleados));
            this.tablify(this.listaEmpleados);
            this.ClearForm();
        };
        Manejadora.eliminarEmpleado = function (legajo) {
            var flagBorro = false;
            for (var i = 0; i < this.listaEmpleados.length; i++) {
                var empleado = this.listaEmpleados[i];
                var legacy = empleado.getLegajo();
                if (legacy === legajo) {
                    this.listaEmpleados.splice(i, 1);
                    flagBorro = true;
                    break;
                }
            }
            if (!flagBorro) {
                alert("No se encontró coincidencia con el Legajo.");
            }
            localStorage.setItem("empleados", JSON.stringify(this.listaEmpleados));
            this.tablify(this.listaEmpleados);
        };
        Manejadora.modificarEmpleado = function (legajo) {
            var flagMod = false;
            alert("not implemented");
            for (var i = 0; i < this.listaEmpleados.length; i++) {
                var empleado = this.listaEmpleados[i];
                if (empleado.getLegajo() === legajo) {
                    flagMod = true;
                    break;
                }
            }
            if (!flagMod) {
                alert("No se encontró coincidencia con el Legajo.");
            }
            localStorage.setItem("empleados", JSON.stringify(this.listaEmpleados));
            this.tablify(this.listaEmpleados);
            this.ClearForm();
        };
        Manejadora.mostrarEmpleados = function () {
            var LSString = String(localStorage.getItem("empleados"));
            if (LSString != null && LSString != "") {
                var listaJson = JSON.parse(LSString);
                {
                    if (listaJson != null) {
                        for (var i = 0; i < listaJson.length; i++) {
                            var legajo = listaJson[i].legajo;
                            var nombre = listaJson[i].nombre;
                            var apellido = listaJson[i].apellido;
                            var edad = listaJson[i].edad;
                            var horario = listaJson[i].horario;
                            var empleado = new SP.Empleado(nombre, apellido, edad, legajo, horario);
                            this.listaEmpleados.push(empleado);
                        }
                        this.tablify(this.listaEmpleados);
                    }
                }
            }
        };
        Manejadora.ClearForm = function () {
            $("#nombre").val("");
            $("#apellido").val("");
            $("#edad").val("");
            $("#horario").val("Masculino");
            $("#nombre").removeClass("is-invalid");
            $("#nmfb").hide();
            $("#apellido").removeClass("is-invalid");
            $("#lnfb").hide();
            $("#edad").removeClass("is-invalid");
            $("#agfb").hide();
            this.nombreValido = false;
            this.apellidoValido = false;
            this.edadValido = false;
        };
        Manejadora.Checkbox_OnChange = function () {
            this.tablify(this.listaEmpleados);
        };
        Manejadora.tablify = function (arrayEmpleados) {
            var mostrarTarde = Boolean($("#filtroTarde").is(":checked"));
            var mostrarManana = Boolean($("#filtroManana").is(":checked"));
            var mostrarNoche = Boolean($("#filtroNoche").is(":checked"));
            var mostrarTodos = Boolean($("#filtroTodos").is(":checked"));
            var html = "<thead><tr><th>Legajo</th><th>Edad</th><th>Nombre</th><th>Apellido</th><th>Horario</th></tr></thead><tbody>";
            arrayEmpleados.forEach(function (empleado) {
                if (mostrarTodos || mostrarManana && empleado.getHorario() === "Mañana" || mostrarTarde && empleado.getHorario() === "Tarde" || mostrarNoche && empleado.getHorario() === "Noche") {
                    html += "<tr>";
                    html += "<td>" + empleado.getLegajo() + "</td>";
                    html += "<td>" + empleado.getEdad() + "</td>";
                    html += "<td>" + empleado.getNombre() + "</td>";
                    html += "<td>" + empleado.getApellido() + "</td>";
                    html += "<td>" + empleado.getHorario() + "</td>";
                    html += "<td><div class='btn-group'>";
                    html += "<button name='Eliminar' class='btn btn-secondary btn-secondary' id='btnDel' onclick='SP.Manejadora.modificarEmpleado(" + empleado.getLegajo() + ")'>Modificar</button>";
                    html += "<button name='Modificar' class='btn btn-secondary btn-danger' id='btnMod' onclick='SP.Manejadora.eliminarEmpleado(" + empleado.getLegajo() + ")'>Eliminar</button>";
                    html += "</div></td>";
                    html += "</tr>";
                }
            });
            html += "</tbody>";
            $("#tabla").html(html);
        };
        Manejadora.filtrarPorHorario = function () {
            var filtro = String($("#txtFiltroHorario").val());
            var arrayFiltrado = this.listaEmpleados.filter(function (empleado, i, array) {
                if (empleado.getHorario() === filtro) {
                    return true;
                }
                return false;
            });
            this.tablify(arrayFiltrado);
        };
        Manejadora.OnLoad = function () {
            this.mostrarEmpleados();
        };
        Manejadora.CheckName = function () {
            var nombre = String($("#nombre").val());
            if (nombre === "" || !nombre.match("^[a-zA-Z]*$")) {
                $("#nombre").addClass("is-invalid");
                $("#nmfb").show();
                this.nombreValido = false;
            }
            else {
                $("#nombre").removeClass("is-invalid");
                $("#nmfb").hide();
                this.nombreValido = true;
            }
        };
        Manejadora.CheckLastName = function () {
            var apellido = String($("#apellido").val());
            if (apellido === "" || !apellido.match("^[a-zA-Z]*$")) {
                $("#apellido").addClass("is-invalid");
                $("#lnfb").show();
                this.apellidoValido = false;
            }
            else {
                $("#apellido").removeClass("is-invalid");
                $("#lnfb").hide();
                this.apellidoValido = true;
            }
        };
        Manejadora.CheckAge = function () {
            var edad = Number($("#edad").val());
            if (edad < 1 || edad > 99) {
                $("#edad").addClass("is-invalid");
                $("#agfb").show();
                this.edadValido = false;
            }
            else {
                $("#edad").removeClass("is-invalid");
                $("#agfb").hide();
                this.edadValido = true;
            }
        };
        Manejadora.CheckBeforeSaving = function () {
            this.CheckAge();
            this.CheckName();
            this.CheckLastName();
            if (this.nombreValido && this.apellidoValido && this.edadValido) {
                this.agregarEmpleado();
            }
        };
        Manejadora.Stats = function () {
            var totalEdades = this.listaEmpleados.reduce(function (total, empleado) {
                return total += empleado.getEdad();
            }, 0);
            var promedio = totalEdades / this.listaEmpleados.length;
            $("#txtPromedio").val(String(promedio));
        };
        Manejadora.listaEmpleados = new Array();
        Manejadora.nombreValido = false;
        Manejadora.apellidoValido = false;
        Manejadora.edadValido = false;
        return Manejadora;
    }());
    SP.Manejadora = Manejadora;
})(SP || (SP = {}));
