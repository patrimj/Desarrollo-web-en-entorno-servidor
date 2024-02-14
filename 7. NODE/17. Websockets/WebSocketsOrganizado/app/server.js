const express = require('express');
const cors = require('cors');
const { socketController } = require('../controllers/websocket-controller');
class MiServer {

    constructor() {
        this.app = express();
        this.usuariosPath = '/api/usuarios';

        //Para websockets.
        this.server = require('http').createServer(this.app); //Este 'http' ya viene con Node. Será el server que tenemos que levantar para los websockets. Tenemos que pasarle el 'this.app'.
        this.io = require('socket.io')(this.server); //Sirve par enviar información de los clientes conectados. Como parámetro: 'this.server'.
        
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
        this.server.listen(process.env.PORT, () => {  //Levantamos ahora el server que permitirá escuchas para el websocket y para las rutas de nuestra API.
                console.log(`Servidor escuchando en: ${process.env.PORT}`);
            })

        //Si todo está bien podremos lanzar la siguiente búsqueda en un navegador: http://localhost:9090/socket.io/socket.io.js --> Esta información la usaremos en la parte de cliente (ver public/index.html).
        //En Angular y React nuestro servidor de sockets será: http://localhost:9090
        // this.app.listen(process.env.PORT, () => {
        //     console.log(`Servidor escuchando en: ${process.env.PORT}`);
        // })
    }
}

module.exports = MiServer;