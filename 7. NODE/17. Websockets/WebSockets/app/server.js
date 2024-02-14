const express = require('express');
const cors = require('cors');
class Server {

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
        this.io.on('connection', socket => {
            //Con este bloque probamos a cargar la url en un navegador: http://localhost:9090/
            console.log("Cliente conectado: ", socket.id); //Estos 'id' son muy volátiles y no es muy correcto usarlos para nada especial. Luego se asociarán los clientes a salas y eso es lo más correcto, gestionarlo en las salas.

            socket.on('disconnect', () => {
                console.log("Cliente desconectado", socket.id);
            });

            //Con esto el servidor escucha al cliente que le envíe este evento: 'enviar-mensaje'.
            // socket.on('enviar-mensaje', (payload) => {
            //     console.log(payload);

            //     //Con lo siguiente, el servidor envía el mensaje a los clientes.
            //     this.io.emit('recibir-mensaje', payload);
            // });

            //Si queremos que el cliente que envío la petición reciba información de retroalimentación, sería así:
            socket.on('enviar-mensaje', (payload, callback) => {
                console.log(payload);
                callback({msg: "Mensaje recibido", id:"1A", fecha: new Date().getTime()});
                this.io.emit('recibir-mensaje', payload); // Con esto, el servidor envía el mensaje a los clientes.
            }); //podría servir para que el cliente reciba alguna confirmación de mensaje recibido. Esto aprovecha el canal de comunicación creado en la petición para enviarle la confirmación.

        });
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

module.exports = Server;