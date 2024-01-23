const path = require('path');
const fs   = require('fs');
const { v4: uuidv4 } = require('uuid');
const { response } = require('express');
const { subirArchivo } = require('../helpers/subir-archivo');

const cargarArchivo = async(req, res = response) => {

    try {
        
        //Estas comprobaciones se pueden poner en un middleware que se aplique en las rutas.
        if(!req.files || Object.keys(req.files).length === 0){
            res.status(404).send("No hay archivos para subir");
            return;
        }

        if(!req.files.archivo){
            res.status(404).send("No hay archivos para subir");
            return;
        }

        console.log("Archivos que vienen en req.files:",req.files);


        //************** Subir el archivo ****************

        //Con este código se suben archivos. Como se reutilizará se ha metido en una librería auxiliar en 'helpers'.
        // const { archivo } = req.files;

        // const nombreCortado = archivo.name.split('.');
        // const extension = nombreCortado[ nombreCortado.length - 1 ];
        // const extensionesValidas = ['png','jpg','jpeg','gif'];
        // if ( !extensionesValidas.includes( extension ) ) {
        //     return res.status(400).json({msg:`La extensión '${extension}' no está permitida. Extensiones válidas: [${extensionesValidas}]`});
        // }

        // const nombreTemporal = uuidv4() + '.' + extension;
        // //const uploadPath = path.join(__dirname, "../uploads/",archivo.name);
        // const uploadPath = path.join(__dirname, "../uploads/",nombreTemporal);
        // archivo.mv(uploadPath,  (err) => {
        //     if (err) {
        //         return res.status(500).json({err});
        //     }
        //     res.json({msg: 'Archivo subido a: ' + uploadPath});
        // });

        //--------------------- Usando el helper ----------------------
        // txt, md
        // const nombre = await subirArchivo( req.files, ['txt','md'], 'textos' );
        const nombre = await subirArchivo( req.files, undefined, 'imgs' );
        res.json({ nombre });


    } catch (msg) {
        res.status(400).json({ msg });
    }

}


const borrarImagen = async(req, res = response ) => {
    const  idborrado = req.params.id;
    const extension = 'jpg';
    const pathImagen = path.join( __dirname, '../uploads', 'imgs', idborrado + '.' + extension );//La extensión debe ser png, jpg, jpeg, gif (la podemos tener almacenada en un campo de la bd).
    console.log( pathImagen );
    if (fs.existsSync(pathImagen)) {
        fs.unlinkSync(pathImagen);
        res.status(200).json({ msg: "Borrado" });
    } else {
        res.status(404).json({ msg: "Archivo no encontrado" });
    }
}


const actualizarImagen = async(req, res = response ) => {

    //Aquí guardaríamos el nombre del archivo en la base de datos (Mongo o MySQL).

    // Limpiar imágenes previas: con este código podemos comprobar el nombre del archivo previo y borrarlo.
    // if ( modelo.img ) { //El campo img del modelo sería un campo String con el nombre del archivo.
    //     // Hay que borrar la imagen del servidor
    //     const pathImagen = path.join( __dirname, '../uploads', coleccion, modelo.img );
    //     if ( fs.existsSync( pathImagen ) ) {
    //         fs.unlinkSync( pathImagen );
    //     }
    // }


    // const nombre = await subirArchivo( req.files, undefined, coleccion );
    // res.json( modelo );
    res.status(200).json({ msg  : "Actual"});
}


const obtenerImagen = async(req, res = response ) => {

    // Cargaríamos el string de la bd (Mongo o SQL) que tiene el nombre del archivo.

    console.log(req.params.id);
    //Para probar, en este ejemplo, el nombre del archivo se lo enviamos en el body. Para probar puedes copiar el nombre de la carpeta upload.
    //En este caso, como es para probar, le añado la extensión jpg al archivo que me pasan porque en la url da fallo el punto. Cuando lo saquemos de la bd no hará falta añadirle la extensión.
    const nombreArchivo = req.params.id + '.jpg'; //Esta chapucilla es solo para probar con el nombre de archivo en la ruta. Cuando lo hagáis, en la ruta irá el id que usaré para buscar el nombre en la bd.
    if (nombreArchivo) {
        // Como es para probar, doy por supuesto que tenemos la carpeta: ../uploads/imgs
        const pathImagen = path.join( __dirname, '../uploads', 'imgs', nombreArchivo );
        console.log(pathImagen);
        if ( fs.existsSync( pathImagen ) ) {
            return res.sendFile( pathImagen )
        }
    }

    const pathImagen = path.join( __dirname, '../assets/no-image.jpg');
    res.sendFile( pathImagen );
}




module.exports = {
    cargarArchivo,
    actualizarImagen,
    obtenerImagen,
    borrarImagen
}