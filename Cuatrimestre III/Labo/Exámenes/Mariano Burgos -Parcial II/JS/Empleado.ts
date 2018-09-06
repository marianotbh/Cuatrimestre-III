namespace SP {
    export class Empleado extends Persona {
        private legajo: number;
        private horario: string;

        constructor(nombre: string, apellido: string, edad: number, legajo: number, horario: string) {
            super(edad, nombre, apellido);
            this.legajo = legajo;
            this.horario = horario;
        }

        public getLegajo(): number {
            return this.legajo;
        }

        public setLegajo(legajo: number): void {
            this.legajo = legajo;
        }

        public getHorario(): string {
            return this.horario;
        }

        public setHorario(horario: string): void {
            this.horario = horario;
        }

        public empleadoToJSON(): string {
            var json = JSON.parse(super.personaToJSON());
            json.legajo = this.getLegajo();
            json.horario = this.getHorario();
            return JSON.stringify(json);
        }
    }
}