var __extends = (this && this.__extends) || (function () {
    var extendStatics = Object.setPrototypeOf ||
        ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
        function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var SP;
(function (SP) {
    var Empleado = /** @class */ (function (_super) {
        __extends(Empleado, _super);
        function Empleado(nombre, apellido, edad, legajo, horario) {
            var _this = _super.call(this, edad, nombre, apellido) || this;
            _this.legajo = legajo;
            _this.horario = horario;
            return _this;
        }
        Empleado.prototype.getLegajo = function () {
            return this.legajo;
        };
        Empleado.prototype.setLegajo = function (legajo) {
            this.legajo = legajo;
        };
        Empleado.prototype.getHorario = function () {
            return this.horario;
        };
        Empleado.prototype.setHorario = function (horario) {
            this.horario = horario;
        };
        Empleado.prototype.empleadoToJSON = function () {
            var json = JSON.parse(_super.prototype.personaToJSON.call(this));
            json.legajo = this.getLegajo();
            json.horario = this.getHorario();
            return JSON.stringify(json);
        };
        return Empleado;
    }(SP.Persona));
    SP.Empleado = Empleado;
})(SP || (SP = {}));
