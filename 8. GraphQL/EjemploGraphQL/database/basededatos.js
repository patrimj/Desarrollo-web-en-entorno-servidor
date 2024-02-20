const { Persona } = require('../models/Persona')

let valores = [new Persona(0, 'Carlos',18), new Persona(1, 'Inés',20), new Persona(2, 'Javi',21), new Persona(3, 'Marina',22)]

const addPersona = (p) => {
    valores.push(p);
}

const getPersonas = () => {
    return valores;
}

const getPersona = (i) => {
    return valores[i];
}

const removePersonaAt = (i) => {
    valores.splice(i, 1);
}

const updatePersonaAt = (i, p) => {
    valores[i] = p;
}

module.exports = {
    // valores,
    getPersonas,
    addPersona,
    getPersona,
    removePersonaAt,
    updatePersonaAt
};