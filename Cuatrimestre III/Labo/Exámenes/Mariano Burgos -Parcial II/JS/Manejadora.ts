namespace SP {
    export class Manejadora {
        private static listaEmpleados: Array<SP.Empleado> = new Array();
        private static nombreValido: boolean = false;
        private static apellidoValido: boolean = false;
        private static edadValido: boolean = false;

        public static LoadForm(id: number) {
            for (var i = 0; i < this.listaEmpleados.length; i++) {
                let empleado: Empleado = this.listaEmpleados[i];
                if (empleado.getLegajo() === id) {
                    $("#legajo").val(empleado.getLegajo());
                    $("#nombre").val(empleado.getNombre());
                    $("#apellido").val(empleado.getApellido());
                    $("#edad").val(empleado.getEdad());
                    $("#horario").val(empleado.getHorario());
                    break;
                }
            }
        }

        public static agregarEmpleado(): void {
            let nombre: string = String($("#nombre").val());
            let apellido: string = String($("#apellido").val());
            let edad: number = Number($("#edad").val());
            let horario: string = String($("#horario").val());
            let legajo: number = Number($("#legajo").val());
            let empleado = new Empleado(nombre, apellido, edad, legajo, horario);
            this.listaEmpleados.push(empleado);
            localStorage.setItem("empleados", JSON.stringify(this.listaEmpleados));
            this.tablify(this.listaEmpleados);
            this.ClearForm();
        }
        public static eliminarEmpleado(legajo: number) {
            let flagBorro: boolean = false;
            for (var i = 0; i < this.listaEmpleados.length; i++) {
                let empleado = this.listaEmpleados[i];
                let legacy = empleado.getLegajo();
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
        }

        public static modificarEmpleado(legajo: number) {
            let flagMod: boolean = false;
            alert("not implemented");
            for (var i = 0; i < this.listaEmpleados.length; i++) {
                let empleado = this.listaEmpleados[i];
                if (empleado.getLegajo() === legajo) {/*
                    empleado.setNombre(String($("#nombre").val()));
                    empleado.setApellido(String($("#apellido").val()));
                    */flagMod = true;
                    break;
                }
            }
            if (!flagMod) {
                alert("No se encontró coincidencia con el Legajo.");
            }

            localStorage.setItem("empleados", JSON.stringify(this.listaEmpleados));
            this.tablify(this.listaEmpleados);
            this.ClearForm();
            
        }
        private static mostrarEmpleados(): void {
            let LSString: string = String(localStorage.getItem("empleados"));
            if (LSString != null && LSString != "") {
                let listaJson = JSON.parse(LSString);
                {
                    if (listaJson != null) {
                        for (var i = 0; i < listaJson.length; i++) {
                            let legajo = listaJson[i].legajo;
                            let nombre = listaJson[i].nombre;
                            let apellido = listaJson[i].apellido;
                            let edad = listaJson[i].edad;
                            let horario = listaJson[i].horario;

                            var empleado = new Empleado(nombre, apellido, edad,legajo,horario);
                            this.listaEmpleados.push(empleado);
                        }
                        this.tablify(this.listaEmpleados);
                    }
                }
            }
        }
        public static ClearForm(): void {
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
        }
        public static Checkbox_OnChange(): void {
            this.tablify(this.listaEmpleados);
        }
        public static tablify(arrayEmpleados: Array<Empleado>): void {
            let mostrarTarde: boolean = Boolean($("#filtroTarde").is(":checked"));
            let mostrarManana: boolean = Boolean($("#filtroManana").is(":checked"));
            let mostrarNoche: boolean = Boolean($("#filtroNoche").is(":checked"));
            let mostrarTodos: boolean = Boolean($("#filtroTodos").is(":checked"));
            let html = "<thead><tr><th>Legajo</th><th>Edad</th><th>Nombre</th><th>Apellido</th><th>Horario</th></tr></thead><tbody>";
            arrayEmpleados.forEach(function (empleado) {
                if(mostrarTodos || mostrarManana && empleado.getHorario() === "Mañana" || mostrarTarde && empleado.getHorario() === "Tarde" || mostrarNoche && empleado.getHorario() === "Noche")
                {
                    html += "<tr>";
                    html += "<td>" + empleado.getLegajo() + "</td>";
                    html += "<td>" + empleado.getEdad() + "</td>";
                    html += "<td>" + empleado.getNombre() + "</td>";
                    html += "<td>" + empleado.getApellido() + "</td>";
                    html += "<td>" + empleado.getHorario() + "</td>";
                    html += "<td><div class='btn-group'>";
                    html += "<button name='Eliminar' class='btn btn-secondary btn-secondary' id='btnDel' onclick='SP.Manejadora.modificarEmpleado("+empleado.getLegajo()+")'>Modificar</button>";
                    html += "<button name='Modificar' class='btn btn-secondary btn-danger' id='btnMod' onclick='SP.Manejadora.eliminarEmpleado("+empleado.getLegajo()+")'>Eliminar</button>";
                    html += "</div></td>"
                    html += "</tr>";
                }
            });
            html += "</tbody>";
            $("#tabla").html(html);
        }
        public static filtrarPorHorario(): void {
            let filtro: String = String($("#txtFiltroHorario").val());
            let arrayFiltrado: Array<Empleado> = this.listaEmpleados.filter(function (empleado: Empleado, i: Number, array: Array<Empleado>) {
                if (empleado.getHorario() === filtro) {
                    return true;
                }
                return false;
            });
            this.tablify(arrayFiltrado);
        }
        public static OnLoad(): void {
            this.mostrarEmpleados();
        }
        public static CheckName(): void {
            let nombre: string = String($("#nombre").val());
            if (nombre === "" || !nombre.match("^[a-zA-Z]*$")) {
                $("#nombre").addClass("is-invalid");
                $("#nmfb").show();
                this.nombreValido = false;
            } else {
                $("#nombre").removeClass("is-invalid");
                $("#nmfb").hide();
                this.nombreValido = true;
            }
        }
        public static CheckLastName(): void {
            let apellido: string = String($("#apellido").val());

            if (apellido === "" || !apellido.match("^[a-zA-Z]*$")) {
                $("#apellido").addClass("is-invalid");
                $("#lnfb").show();
                this.apellidoValido = false;
            } else {
                $("#apellido").removeClass("is-invalid");
                $("#lnfb").hide();
                this.apellidoValido = true;
            }
        }
        public static CheckAge(): void {
            let edad: number = Number($("#edad").val());
            if (edad < 1 || edad > 99) {
                $("#edad").addClass("is-invalid");
                $("#agfb").show();
                this.edadValido = false;
            } else {
                $("#edad").removeClass("is-invalid");
                $("#agfb").hide();
                this.edadValido = true;
            }
        }

        public static CheckBeforeSaving(): void {
            this.CheckAge();
            this.CheckName();
            this.CheckLastName();
            if (this.nombreValido && this.apellidoValido && this.edadValido) {
                this.agregarEmpleado();
            }
        }
        public static Stats(): void {
            let totalEdades: number = this.listaEmpleados.reduce(function (total, empleado) {
                return total += empleado.getEdad();
            }, 0);
            let promedio: number = totalEdades / this.listaEmpleados.length;
            $("#txtPromedio").val(String(promedio));
        }
    }
}