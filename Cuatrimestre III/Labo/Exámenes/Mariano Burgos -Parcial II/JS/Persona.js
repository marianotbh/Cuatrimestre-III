var SP;
(function (SP) {
    var Persona = /** @class */ (function () {
        function Persona(edad, nombre, apellido) {
            this.edad = edad;
            this.nombre = nombre;
            this.apellido = apellido;
        }
        Persona.prototype.getEdad = function () {
            return this.edad;
        };
        Persona.prototype.setEdad = function (edad) {
            this.edad = edad;
        };
        Persona.prototype.getNombre = function () {
            return this.nombre;
        };
        Persona.prototype.setNombre = function (nombre) {
            this.nombre = nombre;
        };
        Persona.prototype.getApellido = function () {
            return this.apellido;
        };
        Persona.prototype.setApellido = function (apellido) {
            this.apellido = apellido;
        };
        Persona.prototype.personaToJSON = function () {
            return '"nombre":"' + this.getNombre() + '","apellido":"' + this.getApellido() + '","edad":' + this.getEdad() + '"';
        };
        return Persona;
    }());
    SP.Persona = Persona;
})(SP || (SP = {}));
