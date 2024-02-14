const lblOn         = document.querySelector('#lblOn');
const lblOff        = document.querySelector('#lblOff');
const txtMensaje    = document.querySelector('#txtMensaje');
const btnEnviar     = document.querySelector('#btnEnviar');

const socket = io(); //De la librería de socket.io que ya hemos cargado en index.html.
//Aquí estará toda la configuración y comunicación de mi websockets con el servidor.
console.log("Funcionando...");

//socket.on --> se quedará escuchando el evento que le pasemos: 'connect', 'disconnect',...
//Para probar esto, como curiosidad: podemos tirar el servidor y tratar de acceder con un navegador a http://localhost:9090 --> dará un error. 
//Pero si dejamos el navegador abbierto y levantamos el servidor, al cabo de un instante, sin tocar nada: funciona la conexión.
socket.on('connect', () => {
    console.log("Conectado");
    lblOff.style.display = 'none';
    lblOn.style.display = '';
});

socket.on('disconnect', () => {
    console.log("Desconectado");
    lblOff.style.display = '';
    lblOn.style.display = 'none';
});

//Emisión del cliente al servidor.
btnEnviar.addEventListener('click', () => {
    const mensaje = txtMensaje.value;
    // console.log(mensaje);
    //socket.emit('enviar-mensaje', mensaje);//Podemos enviarle el texto o, más interesante: un objeto con información.
    const payload = {
        mensaje,
        id: '1A', //Puede ser el id del usuario.
        fecha: new Date().getTime()
    }
    //socket.emit('enviar-mensaje', payload);
    //Si queremos leer la confirmación del servidor.
    socket.emit('enviar-mensaje', payload, (msg_conf) =>{
        console.log("Desde el servidor se recibe esta confirmación: " , msg_conf);
    });

});


//Todos los clientes escuchan este mensaje, si llega lo destripan.
socket.on('recibir-mensaje', (payload) => {
    console.log("Recibido desde el servidor: ", payload);
});