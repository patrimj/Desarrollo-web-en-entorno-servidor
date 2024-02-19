const express = require('express');
// const body_parser = require('body-parser');
const cors = require('cors');
class Server {

    constructor() {
        this.app = express();
        this.usuariosPath = '/api/usuarios';
        this.authPath     = '/api/auth';

        //Middlewares
        this.middlewares();

        this.routes();
        
    }

    middlewares() {
        this.app.use(cors());
        this.app.use(express.json());

        this.app.use(express.static('public'));
    }

    routes(){
        this.app.use(this.authPath , require('../routes/auth'));
        this.app.use(this.usuariosPath , require('../routes/userRoutes'));
    }

    listen() {
        this.app.listen(process.env.PORT, () => {
            console.log(`Servidor escuchando en: ${process.env.PORT}`);
        })
    }
}

module.exports = Server;