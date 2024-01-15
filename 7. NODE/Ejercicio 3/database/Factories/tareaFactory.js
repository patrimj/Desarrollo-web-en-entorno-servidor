const faker = require('faker');
const Tarea = require('../models/Tarea');

const descripcion = faker.lorem.sentence();
const duracion = faker.random.number({ min: 1, max: 10 });
const dificultades = ['XS', 'S', 'M', 'L', 'XL'];
const dificultad = faker.random.arrayElement(dificultades);
const realizada = faker.random.boolean();

const tarea = new Tarea(descripcion, duracion, dificultad, realizada);

console.log(tarea);