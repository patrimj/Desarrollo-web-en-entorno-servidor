require('dotenv').config()

//socket.io es el equivalente de express. Se puede hacer una API Rest sin express pero ayuda a hacerlo de forma más rápida y clara. Lo mismo con socket.io.

const MiServer = require('./server');
const server = new MiServer();

server.listen();


