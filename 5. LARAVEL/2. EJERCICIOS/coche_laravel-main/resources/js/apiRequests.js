// esto para importar este archivo en otros archivos js
///import * as apiRequests from './apiRequests.js'; // este 
//const apiRequests = require('./apiRequests.js');// o este

//funciones para hacer las peticiones

// Función para hacer una petición GET
function getUsuarios() {
    fetch('http://127.0.0.1:9090/api/usuarios')
      .then(response => response.json())
      .then(data => console.log(data))
      .catch((error) => {
        console.error('Error:', error);
      });
  }
  
  // Función para hacer una petición POST
  function crearUsuario(usuario) {
    fetch('http://127.0.0.1:9090/api/usuarios', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(usuario),
    })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch((error) => {
      console.error('Error:', error);
    });
  }
  
  // Función para hacer una petición PUT
  function modificarUsuario(dni, usuario) {
    fetch(`http://127.0.0.1:9090/api/usuarios/${dni}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(usuario),
    })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch((error) => {
      console.error('Error:', error);
    });
  }
  
  // Función para hacer una petición DELETE
  function borrarUsuario(dni) {
    fetch(`http://127.0.0.1:9090/api/usuarios/${dni}`, {
      method: 'DELETE',
    })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch((error) => {
      console.error('Error:', error);
    });
  }

  //para probar las funciones
    getUsuarios();
    //crearUsuario({dni: 12345678, nombre: 'Juan', apellido: 'Perez', email: 'juanperez@gmail', telefono: 123456789});
    //modificarUsuario(12345678, {nombre: 'Juan', apellido: 'Perez', email: 'juanperez@gmail', telefono: 123456789});
    //borrarUsuario(12345678);
