const express = require('express');
const cors = require('cors');
const { socketController } = require('../controllers/websocket-controller');
class MiServer {

    constructor() {
        this.app = express();
        this.usuariosPath = '/api/usuarios';

        //Para websockets.
        // this.server = require('http').createServer(this.app); //Este 'http' ya viene con Node. Será el server que tenemos que levantar para los websockets. Tenemos que pasarle el 'this.app'.
        // this.io = require('socket.io')(this.server); //Sirve par enviar información de los clientes conectados. Como parámetro: 'this.server'.

        this.serverExpress = require('http').createServer(this.app);
        this.serverWebSocket = require('http').createServer(this.app);
        this.io = require('socket.io')(this.serverWebSocket);

        
        //Middlewares
        this.middlewares();

        //Rutas API.
        this.routes();

        //Websockets.
        this.sockets();
        
    }

    middlewares() {
        this.app.use(cors());
        this.app.use(express.json());

        //Directorio públco: http://localhost:9090/  --> Habilitamos esto para ver como se cargaría una imagen desde el cliente.
        this.app.use(express.static('public'));
    }

    routes(){
        this.app.use(this.usuariosPath , require('../routes/userRoutes'));
    }

    sockets(){
        this.io.on('connection', socketController);
    }

    listen() {
        this.serverExpress.listen(process.env.PORT, () => {
            console.log(`Servidor Express escuchando en: ${process.env.PORT}`);
            });

        this.serverWebSocket.listen(process.env.WEBSOCKETPORT, () => {
            console.log(`Servidor de WebSockets escuchando en: ${process.env.WEBSOCKETPORT}`);
        });
    }
}

module.exports = MiServer;