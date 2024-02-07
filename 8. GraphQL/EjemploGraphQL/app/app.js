require('dotenv').config()

const Server = require('./server');
const server = new Server();

// server.listen();
server.start().catch(console.error);


// console.log(`Datos de conexión: ${process.env.DB_NAME} ${process.env.DB_USER} ${process.env.DB_PASSWORD}`);

