const faker = require('faker');
const Persona = require('../../models/Persona');
const { faker} = require('@faker-js/faker');

function crearPersona() {
    const nombre = faker.person.firstName();
    const email = faker.internet.email();
    const password = faker.internet.password();

    return new Persona(nombre, email, password);
}

module.exports = crearPersona;