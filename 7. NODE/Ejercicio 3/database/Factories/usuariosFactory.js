const faker = require('faker');
const Persona = require('../models/Persona');

function crearPersona() {
    const nombre = faker.name.findName();
    const email = faker.internet.email();

    return new Persona(nombre, email);
}

for (let i = 0; i < 10; i++) {
    const persona = crearPersona();
    console.log(persona);
}