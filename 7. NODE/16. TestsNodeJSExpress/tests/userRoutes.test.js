const request = require('supertest');
const express = require('express');
const routes = require('../routes/userRoutes')

const app = express();
app.use(express.json());
app.use('/', routes);

describe('Testeo de rutas GET', () => {
  it('GET / debería retornar un código 200', async () => {
    const response = await request(app).get('/');
    expect(response.statusCode).toBe(200);
  });

  it('GET /:id? debería retornar un código 200', async () => {
    const response = await request(app).get('/0');
    expect(response.statusCode).toBe(200);
  });
});


describe('Testeo de ruta POST', () => {
   it('POST / debería retornar un código 200', async () => {
    const nuevoUsuario = {
      nombre: "Laura",
      edad:19
    }
    const response = await request(app).post('/').send(nuevoUsuario) 
    expect(response.statusCode).toBe(201);
    expect(response.body.msg).toBe('Elemento insertado');
    expect(response.body.valores.valores).toContainEqual(nuevoUsuario);

    const getResponse = await request(app).get('/');
    expect(getResponse.statusCode).toBe(200);
    expect(getResponse.body.valores.valores).toContainEqual(nuevoUsuario);
  });
});

describe('Pruebas de solicitud PUT', () => {
  it('Debería actualizar un usuario existente', async () => {
    const usuarioActualizado = {
      nombre: "DAW2",
      edad:45
    }

    const response = await request(app)
      .put('/0') 
      .send(usuarioActualizado);

    
    expect(response.statusCode).toBe(202);
    expect(response.body.msg).toBe('Elemento modificado');
    expect(response.body.valores.valores[0]).toEqual(usuarioActualizado);

    const getResponse = await request(app).get('/');
    expect(getResponse.statusCode).toBe(200);
    expect(getResponse.body.valores.valores[0]).toEqual(usuarioActualizado);
  });
});

describe('Pruebas de solicitud DELETE', () => {
  it('Debería eliminar un usuario existente', async () => {
    const response = await request(app).delete('/0');

    expect(response.statusCode).toBe(202);
    expect(response.body.msg).toBe('Elemento borrado');

    //Podemos comprobar que hemos borrado correctamente a ese usuario si modificamos el valor devuelto por la ruta DELETE para que incluya al elemento borrado y poder comprobar que no está.
    //const getResponse = await request(app).get('/');
    //expect(getResponse.body.valores.valores).not.toContainEqual({ nombre: response.body.valores.nombre, edad: response.body.valores.edad });

  });
});