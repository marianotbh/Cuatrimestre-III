namespace SP {
    export class Persona {
        private nombre: string;
        private apellido: string;
        private edad: number;

        constructor(edad: number, nombre: string, apellido: string) {
            this.edad = edad;
            this.nombre = nombre;
            this.apellido = apellido;
        }

        public getEdad(): number {
            return this.edad;
        }

        public setEdad(edad: number): void {
            this.edad = edad;
        }

        public getNombre(): string {
            return this.nombre;
        }

        public setNombre(nombre: string): void {
            this.nombre = nombre;
        }

        public getApellido(): string {
            return this.apellido;
        }

        public setApellido(apellido: string): void {
            this.apellido = apellido;
        }

        public personaToJSON(): string {
            return '"nombre":"' + this.getNombre() + '","apellido":"' + this.getApellido() + '","edad":' + this.getEdad() + '"';
        }

        
    }
}