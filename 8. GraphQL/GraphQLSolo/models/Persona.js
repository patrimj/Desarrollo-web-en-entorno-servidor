class Persona {
    nombre = '';
    edad = 0;
    
    constructor(id, n = '', e = 0){
        this.id = id
        this.nombre = n;
        this.edad = e;
    }
}

module.exports = {Persona}