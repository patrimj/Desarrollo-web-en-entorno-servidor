const socketController2 = (socket) => {
    //Con este bloque probamos a cargar la url en un navegador: http://localhost:9090/
    console.log(`Cliente ${socket.id} conectado en ${process.env.WEBSOCKETPORT2}`); //Estos 'id' son muy volátiles y no es muy correcto usarlos para nada especial. Luego se asociarán los clientes a salas y eso es lo más correcto, gestionarlo en las salas.

    socket.on('disconnect', () => {
        console.log(`Cliente ${socket.id} desconectado en ${process.env.WEBSOCKETPORT2}`);
    });

    //Con esto el servidor escucha al cliente que le envíe este evento: 'enviar-mensaje'.
    // socket.on('enviar-mensaje', (payload) => {
    //     console.log(payload);

    //     //Con lo siguiente, el servidor envía el mensaje a los clientes.
    //     this.io.emit('recibir-mensaje', payload);
    // });

    //Si queremos que el cliente que envío la petición reciba información de retroalimentación, sería así:
    socket.on('enviar-mensaje', (payload, callback) => {
        console.log(`Mensaje recibido en ${process.env.WEBSOCKETPORT2}: ${JSON.stringify(payload, null, 2)} de ${socket.id}`);
        callback({msg: "Mensaje recibido DE OTRO...", id:"1A", fecha: new Date().getTime()});
        // callback({msg: "Mensaje recibido", payload: payload});
        //Con lo siguiente, el servidor envía el mensaje a los clientes.
        socket.broadcast.emit('recibir-mensaje', payload);
    }); //podría servir para que el cliente reciba alguna confirmación de mensaje recibido. Esto aprovecha el canal de comunicación creado en la petición para enviarle la confirmación.

}

module.exports = {
    socketController2
}