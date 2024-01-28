var http = require('http');
 
http.createServer(function (req, res) {
    //Respondiendo HTML.
    // res.writeHead(200, {'Content-Type': 'text/html'});
    // res.end('Hola Mundo!');

    //Respondiendo JSON.
    res.writeHead(200, { 'Content-Type': 'application/json' });
    res.write(JSON.stringify({ nombre: "Fernando", apellido: "Aranzabe" }));
    res.end();
}).listen(8090);

console.log("Servidor arrancado en 8090...");
