require('dotenv').config()

const Server = require('./server');

//Lo siguiente es para probar la conexión.
// const conx = new Conexion();
// conx.conectar();
// conx.getlistado()    
//     .then( msg => {
//         console.log('Listado correcto!')
//         console.log(msg) 
//     })
//     .catch( err => {
//         console.log('Algo ha fallado!')
//         console.log( err ) 
//     });
// conx.desconectar();

//Lanzamos el servidor.
const server = new Server();
server.listen();

// const p = new Persona('1A','Fernando',32565);
// console.log(p);



console.log(`Datos de conexión: ${process.env.DB_DATABASE} ${process.env.DB_USER}`);

