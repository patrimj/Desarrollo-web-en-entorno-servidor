# EJERCICIO RESUMEN NODEJS
---

## ÍNDICE
[1. COMANDOS UTILIZADOS](#1-comandos-utilizados)

[2. ESTRUCTURA DE ARCHIVOS](#2-estructuración-de-archivos)

[3. MANUAL DE USO DE LA API](#3-manual-de-uso-de-la-api)

[4. SUBIR IMÁGENES](#4-imagenes)

[5. MONGODB](#5-mongodb)

---
## 1. COMANDOS UTILIZADOS
- Crea el package.json e ``inicializa el proyecto``
```bash
npm init -y 
```
- Instalación de la librería ``express``
```bash
npm install express
```
- Instalación global de ``nodemon``, para que se reinicie el servidor cada vez que se haga un cambio
```bash
npm install -g nodemon 
npm install --save-dev nodemon 
```
- Instalación de la librería dotenv, para crear el archivo ``.env``
```bash
npm install dotenv --save 
```
-  Instalación de todas las dependencias del package.json y la carpeta ``node_modules``
``` bash
npm install 
```
- Instalación de la librería cors, para evitar problemas de ``CORS``
```bash
npm install cors
```
- Instalación de la librería ``mysql2``, para trabajar con la base de datos
```bash
npm install mysql2 
```
- Instalación de la librería ``bcrypt``, para encriptar contraseñas
```bash
npm install bcrypt 
```
- Instalación de la librería ``validator``, para validar campos en las rutas
```bash
npm install validator
npm install express-validator
```
- Instalación de la librería ``jsonwebtoken``, para generar tokens
```bash
npm install jsonwebtoken 
```
- Instalación de la librería ``faker``, para generar datos falsos
```bash
npm i @faker-js/faker 
```
- Instalación de la librería ``sequelize``, para trabajar con la base de datos
```bash
npm install --save sequelize 
npm install sequelize sqlite3 
```
- Para instalar las dependecias de ``migrations``
```bash
npm install --save-dev sequelize-cli

```
- Instalación de ``sequelize-cli``, para trabajar con la base de datos
```bash
npx sequelize-cli init 
```
- Crear ``modelos``
```bash
npx sequelize-cli model:generate --name User --attributes firstName:string,lastName:string,email:string 
```
- Crear y migrar``tablas``
```bash
npx sequelize-cli db:migrate 
npx sequelize-cli db:migrate --to 20240121203206-create-roles.js
npx sequelize-cli db:migrate --to 20240116185326-create-user.js  
npx sequelize-cli db:migrate --to 20240121203217-create-rol-asignado.js
npx sequelize-cli db:migrate --to 20240121203253-create-tarea.js  
npx sequelize-cli db:migrate --to 20240121203310-create-tarea-asignada.js
```
- Hacer un rollback de las ``tablas``
```bash
npx sequelize-cli db:migrate:undo 
```
- Crear ``seeders``
```bash
npx sequelize-cli seed:generate --name userSeeder
npx sequelize-cli seed:generate --name rolSeeder
npx sequelize-cli seed:generate --name rolAsigSeeder
npx sequelize-cli seed:generate --name tareaSeeder
npx sequelize-cli seed:generate --name tareaAsigSeeder
```
- Introducir datos en las ``tablas``
```bash
npx sequelize-cli db:seed --seed 20240121203409-rolSeeder.js
npx sequelize-cli db:seed --seed 20240121203400-userSeeder.js 
npx sequelize-cli db:seed --seed 20240121203419-rolAsigSeeder.js
npx sequelize-cli db:seed --seed 20240121203428-tareaSeeder.js
npx sequelize-cli db:seed --seed 20240121203435-tareaAsigSeeder.js
```
---

## 2. ESTRUCTURACIÓN DE ARCHIVOS
> ## app
> > ``app.js`` [copiado el archivo ``app.js`` del profesor]

> > ``server.js`` [copiado en un principio el archivo ``server.js`` del profesor]

> ## config
> > ``config.js`` [copiado el archivo ``config.js`` del profesor]
```bash
require('dotenv').config();

module.exports ={
  "development": {
    "username": process.env.DB_USER,
    "password": process.env.DB_PASSWORD,
    "database": process.env.DB_DEV,
    "host": process.env.HOST,
    "dialect": process.env.DB_DIALECT
  },
  "test": {
    "username": process.env.DB_USER,
    "password": process.env.DB_PASSWORD,
    "database": process.env.DB_TEST,
    "host": process.env.HOST,
    "dialect": process.env.DB_DIALECT
  },
  "production": {
    "username": process.env.DB_USER,
    "password": process.env.DB_PASSWORD,
    "database": process.env.DB_PROD,
    "host": process.env.HOST,
    "dialect": process.env.DB_DIALECT
  }
}
```

> ## controllers
> > ``tarea.controller.js``

> > ``usuario.controller.js``

> ## database
> > ``ConexionSequelize.js`` 

> > ``connection.js``

> > ``tarea.conexion.js``

> > ``usuario.conexion.js``

> ## factories 

> [!NOTE]
> Las factorias se crean [SIN] comando

> > ``rol.factory.js`` [faker]

> > ``rol_asignado.factory.js`` [faker] 

> > ``usuario.factory.js`` [faker]

> > ``tarea.factory.js`` [faker]

> > ``tarea_asignada.factory.js`` [faker] 


> ## helpers
> > ``CustomError.js`` [copiado el archivo ``CustomError.js`` del profesor]

> > ``db-validators.js`` [se encuentran los validators personalizados]

> > ``generate_jwt.js`` [se encuentra la función para generar el token] 
```javascript
const jwt = require('jsonwebtoken')

const generarJWT = (id_usuario = '') => {

    console.log("id:" + id_usuario)
    let token = jwt.sign({ id_usuario }, process.env.SECRETORPRIVATEKEY, { 
        expiresIn: '4y' // 24 hours
      });
    return token;
}

module.exports ={
    generarJWT
}
```
*** en ``.env`` se encuentra la clave secreta para generar el ``token`` ***
```bash
SECRETORPRIVATEKEY=eST0EsmiPiblic@key
```
*** en ``controllers`` pondriamos una función para generar el token ***
```javascript
const { generarJWT } = require('../helpers/jwt');

const login =  (req, res = response) => {
    const {email, password} = req.body;
    try{
        //Verificar si existe el usuario.
        const conx = new ConexionUsuario();
        u = conx.login(email, password)    
            .then( usu => {
                console.log('Usuario correcto!  ' + usu[0].id);
                const token = generarJWT(usu[0].id)
                console.log(usu)
                console.log(token);
                res.status(200).json({usu, token});
            })
            .catch( err => {
                console.log('No hay registro de ese usuario.');
                res.status(500).json({'msg':'Login incorrecto.'});
            });
            

        //res.status(200).json({'msg':'Login ok', DNI, Clave});
    }
    catch(error){
        console.log(error);
        res.status(500).json({'msg':'Error en el servidor.'});
    }
}
```
-  y asi cada vez que se inicie sesión se generará un token con el id del usuario

> ## middlewares
> > ``validar-admin.js`` [ para validar si el usuario es admin]

> > ``validarJWT.js`` [ para validar el token]
```javascript
const jwt = require('jsonwebtoken');
const {response, request} = require('express')  //Incorporamos esto aquí porque vamos a añadir elementos a req que sacaremos del token.

const validarJWT = (req , res , next) => {  //Estas asignaciones son necesarias para almacenar en el request los datos que extraigamos del token.
    const token = req.header('x-token');  //Este nombre será establecido en el cliente también.

    if (!token){
        return res.status(401).json({'msg':'No hay token en la petición.'});
    }

    try {
        
        const {id} = jwt.verify(token, process.env.SECRETORPRIVATEKEY);
        req.idToken = id;
        console.log(id);
        console.log(token);
        next();
        
    }catch(error){
        console.log(error);
        res.status(401).json({'msg':'Token no válido.'});
    }
}

module.exports = {
    validarJWT
}
```

> ## migrations y models
>
> > ``index.js`` [es el archivo que se encarga de la conexión con la base de datos]

> [!NOTE]
> CUIDADO CON INDEX.JS (no sacarlo de la carpeta models)  
> Cambiar de congif/config.json a config/config.js 
```bash
Const config = require(__dirname + '/../config/config.js')[env]; 
```

> > ``roles.js`` [es el modelo que seguira la tabla roles] y ``20240121203206-create-roles.js``
```bash
npx sequelize-cli model:generate --name Roles --attributes nombre:string  
```
> > ``rol_asignado.js`` [es el modelo que seguira la tabla rol_asignado] y ``20240121203217-create-rol-asignado.js``
```bash
npx sequelize-cli model:generate --name Rol_Asignado --attributes id_rol:integer,id_usuario:integer 
```
> > ``user.js`` [es el modelo que seguira la tabla usuarios] y ``20240116185326-create-user.js``
```bash
npx sequelize-cli model:generate --name User --attributes nombre:string,email:string,password:string
```
> > ``tarea.js`` [es el modelo que seguira la tabla tareas] y ``20240121203253-create-tarea.js``
```bash
npx sequelize-cli model:generate --name Tarea --attributes descripcion:string,dificultad:string,horas_previstas:integer,horas_realizadas:integer,porcentaje_realizacion:integer,completada:boolean
```
> > ``tarea_asignada.js`` [es el modelo que seguira la tabla tarea_asignada] y ``20240121203310-create-tarea-asignada.js``
```bash
npx sequelize-cli model:generate --name Tarea_Asignada --attributes id_tarea:integer,id_usuario:integer
```
> [!CAUTION]
> id:integer > no se pone porque viene por defecto

> [!IMPORTANT]
>Todos estos comandos crearán un archivo de tipo `XXXXXXXXXXXXXX-create-user.j` en la carpeta `/migrations` y un archivo `user.js` en la carpeta `/models`

> ## routes
> > ``tareaRoutes.js``

> > ``usuarioRoutes.js``

> ## seeders
> > ```20240121203409-rolSeeder.js```
```bash
npx sequelize-cli db:seed --seed 20240121203409-rolSeeder.js
```
> > ```20240121203400-userSeeder.js```
```bash
npx sequelize-cli db:seed --seed 20240121203400-userSeeder.js 
```
> > ```20240121203419-rolAsigSeeder.js```
```bash
npx sequelize-cli db:seed --seed 20240121203419-rolAsigSeeder.js
```
> > ```20240121203428-tareaSeeder.js```
```bash
npx sequelize-cli db:seed --seed 20240121203428-tareaSeeder.js
```
> > ```20240121203435-tareaAsigSeeder.js```
```bash
npx sequelize-cli db:seed --seed 20240121203435-tareaAsigSeeder.js
```
> ## .env
```bash
PORT=9090

DB_HOST="localhost"
DB_USER="root"
DB_PASSWORD=""

DB_DEV="tareaMigSeedNode_dev"
DB_PROD="tareaMigSeedNode_prod"
DB_TEST="tareaMigSeedNode_test"

DB_DIALECT="mysql"
DB_HOST="localhost"
DB_PORT=3306
DB_MAXCONNECTIONS=5

SECRETORPRIVATEKEY=eST0EsmiPiblic@key
```
---
## 3. MANUAL DE USO DE LA API

## RUTAS USUARIOS

---
#### Registrar usuario

- URL: `http://localhost:9090/api/registrarse`
- Método: `POST`
- Datos requeridos:
  - `nombre`: Nombre del usuario (string, requerido)
  - `email`: Email del usuario (string, requerido, único)
  - `password`: Contraseña del usuario (string, requerido)

##### Ejemplo de solicitud para registrar usuario
```json
{
  "nombre" : "Patricia",
  "email" : "patricia@correo.com",
  "password": "admin123"
}
```
---
#### Iniciar sesión

- URL: `http://localhost:9090/api/login`
- Método: `POST`
- Datos requeridos:
  - `email`: Email del usuario (string, requerido)
  - `password`: Contraseña del usuario (string, requerido)
- Datos de respuesta:
  - `token`: Token de autenticación (string)
  
##### Ejemplo de solicitud para iniciar sesión
```json
{
  "email" : "patricia@correo.com",
  "password": "admin123"
}
```
##### Ejemplo de respuesta al iniciar sesión 
*** El token no caducará en 4 años ***
```json
{
  "usu": {
    "id": 6,
    "nombre": "Patricia",
    "email": "patricia@correo.com",
    "password": "admin123",
    "createdAt": "2024-01-22T18:11:01.000Z",
    "updatedAt": "2024-01-22T18:11:01.000Z"
  },
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZF91c3VhcmlvIjo2LCJpYXQiOjE3MDU5NDkxMTEsImV4cCI6MTgzMjE3OTUxMX0.vQtwVqQhZuKAERIPvuP9AkUNnwknbW4HuSyySEQokOg"
}
```

- El token deberá ser enviado en el header de las peticiones que lo requieran, con el nombre `x-token`.
- Headers > x-token > eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZF91c3VhcmlvIjo2LCJpYXQiOjE3MDU5NDk3NTQsImV4cCI6MTgzMjE4MDE1NH0.jd6Kv7BDy6ogLXMyK5QpNS5e8eoz_1BHueRNIBmpmhE
---

#### Cambiar contraseña

- URL: `http://localhost:9090/api/perfil/password/:email`
- Método: `PUT`
- Datos requeridos:
  - `password`: Contraseña del usuario (string, requerido)
  - `token`: Token de autenticación (string)
- Parámetros de ruta:
  - `email`: Email del usuario (string, requerido)

##### Ejemplo de solicitud para cambiar contraseña
```json
{
  "password": "admin123"
}
```
---
## RUTAS PROGRAMADORES
---
#### LISTAR TAREAS LIBRES

- URL: `http://localhost:9090/api/tareas/libres`
- Método: `GET`
- Datos requeridos:
  - `token`: Token de autenticación (string)
---
#### ASIGNAR TAREA

- URL: `http://localhost:9090/api/tarea/asignar/:id`
- Método: `PUT`
- Parámetros de ruta:
  - `id`: ID de la tarea (integer, requerido)
- Datos requeridos:
  - `token`: Token de autenticación (string)
---
#### QUITARSE TAREA

- URL: `http://localhost:9090/api/tarea/desasignar/:id`
- Método: `PUT`
- Parámetros de ruta:
  - `id`: ID de la tarea (integer, requerido)
- Datos requeridos:
  - `token`: Token de autenticación (string)
---
#### LISTAR TAREAS ASIGNADAS

- URL: `http://localhost:9090/api/tareas/asignadas`
- Método: `GET`
- Datos requeridos:
  - `token`: Token de autenticación (string)
---
#### CONSULTAR TAREA ASIGNADA

- URL: `http://localhost:9090/api/tarea/asignada/:id`
- Método: `GET`
- Parámetros de ruta:
  - `id`: ID de la tarea (integer, requerido)
- Datos requeridos:
  - `token`: Token de autenticación (string)
---
#### LISTAR TODAS LAS TAREAS

- URL: `http://localhost:9090/api/tareas`
- Método: `GET`
- Datos requeridos:
  - `token`: Token de autenticación (string)
---
## RUTAS ADMINISTRADORES
---
#### Dar de alta usuario

- URL: `http://localhost:9090/api/usuario/alta`
- Método: `POST`
- Datos requeridos:
  - `nombre`: Nombre del usuario (string, requerido)
  - `email`: Email del usuario (string, requerido, único)
  - `password`: Contraseña del usuario (string, requerido)
  - `token`: Token de autenticación (string)

##### Ejemplo de solicitud para dar de alta usuario
```json
{
  "nombre" : "Patricia",
  "email" : "patricia@correo.com",
  "password": "admin123"
}
```
---
#### Dar de baja usuario

- URL: `http://localhost:9090/api/usuario/baja/:id`
- Método: `DELETE`
- Parámetros de ruta:
  - `id`: ID del usuario (integer, requerido)
- Datos requeridos:
  - `token`: Token de autenticación (string)
---
#### Modificar usuario

- URL: `http://localhost:9090/api/usuario/modificar/:id`
- Método: `PUT`
- Parámetros de ruta:
  - `id`: ID del usuario (integer, requerido)
- Datos requeridos:
  - `nombre`: Nombre del usuario (string, requerido)
  - `email`: Email del usuario (string, requerido, único)
  - `password`: Contraseña del usuario (string, requerido)
  - `token`: Token de autenticación (string)

##### Ejemplo de solicitud para modificar usuario
```json
{
  "nombre" : "Patricia",
  "email" : "patricia@correo.com",
  "password": "admin123"
}
```
---
#### Crear tarea

- URL: `http://localhost:9090/api/tarea/crear`
- Método: `POST`
- Datos requeridos:
  - `descripcion`: Descripción de la tarea (string, requerido)
  - `dificultad`: Dificultad de la tarea (string, requerido)
  - `horas_previstas`: Horas previstas de la tarea (integer, requerido)
  - `horas_realizadas`: Horas realizadas de la tarea (integer, requerido)
  - `porcentaje_realizacion`: Porcentaje de realización de la tarea (integer, requerido)
  - `completada`: Completada de la tarea (boolean, requerido)
  - `token`: Token de autenticación (string)

##### Ejemplo de solicitud para crear tarea
```json
{
  "descripcion" : "Tarea 1",
  "dificultad" : "L",
  "horas_previstas": 10,
  "horas_realizadas": 5,
  "porcentaje_realizacion": 50,
  "completada": false
}
```
---
#### Modificar tarea

- URL: `http://localhost:9090/api/tarea/modificar/:id`
- Método: `PUT`
- Parámetros de ruta:
  - `id`: ID de la tarea (integer, requerido)
  - `token`: Token de autenticación (string)
- Datos requeridos:
  - `descripcion`: Descripción de la tarea (string, requerido)
  - `dificultad`: Dificultad de la tarea (string, requerido)
  - `horas_previstas`: Horas previstas de la tarea (integer, requerido)
  - `horas_realizadas`: Horas realizadas de la tarea (integer, requerido)
  - `porcentaje_realizacion`: Porcentaje de realización de la tarea (integer, requerido)
  - `completada`: Completada de la tarea (boolean, requerido)
  - `token`: Token de autenticación (string)

##### Ejemplo de solicitud para modificar tarea
```json
{
  "descripcion" : "Tarea 1",
  "dificultad" : "S",
  "horas_previstas": 10,
  "horas_realizadas": 5,
  "porcentaje_realizacion": 50,
  "completada": false
}
```
---
#### Eliminar tarea

- URL: `http://localhost:9090/api/tarea/eliminar/:id`
- Método: `DELETE`
- Parámetros de ruta:
  - `id`: ID de la tarea (integer, requerido)
- Datos requeridos:
  - `token`: Token de autenticación (string)
---
#### Asignar tarea a usuario

- URL: `http://localhost:9090/api/tarea/asignar/:id/:id_usuario`
- Método: `PUT`
- Parámetros de ruta:
  - `id`: ID de la tarea (integer, requerido)
  - `id_usuario`: ID del usuario (integer, requerido)
- Datos requeridos:
  - `token`: Token de autenticación (string)
---
#### Ver tareas programador

- URL: `http://localhost:9090/api/tareas/programador/:id_usuario`
- Método: `GET`
- Parámetros de ruta:
  - `id_usuario`: ID del usuario (integer, requerido)
- Datos requeridos:
  - `token`: Token de autenticación (string)
---
#### Ver tareas realizadas

- URL: `http://localhost:9090/api/tareas/realizadas`
- Método: `GET`
- Datos requeridos:
  - `token`: Token de autenticación (string)
---
#### Ver tareas pendientes

- URL: `http://localhost:9090/api/tareas/pendientes`
- Método: `GET`
- Datos requeridos:
  - `token`: Token de autenticación (string)
---
#### Ver ranking de tareas

- URL: `http://localhost:9090/api/ranking`
- Método: `GET`
- Datos requeridos:
  - `token`: Token de autenticación (string)
---

## 4. IMAGENES

- Paquete express-fileupload
```bash
npm install express-fileupload
```
- Paquete uuid para generar un nombre único a la imagen
```bash
npm install uuid
```

### RUTAS

```JavaScript
const { Router } = require('express');

const { validarArchivoSubir } = require('../middlewares/validar-archivo');
const { cargarArchivo, actualizarImagen, obtenerImagen, borrarImagen } = require('../controllers/uploads');
//const { coleccionesPermitidas } = require('../helpers');


const router = Router();


router.post( '/', validarArchivoSubir, cargarArchivo );

router.put('/:id', actualizarImagen )

router.delete('/:id', borrarImagen  )

//router.get('/:coleccion/:id', obtenerImagen  )  //Lo más correcto sería pasar el id en ruta, buscar ese documento en la bd y obtener el campo string con el nombre del archivo.
router.get('/:id', obtenerImagen  )  //Para probar le pasaré el nombre del archivo en el body, por ejemplo: {"nomArchivo":"470fc03f-92cc-4cad-800a-f696d4e676b2.jpeg"}  

module.exports = router;
```
> > Controller > uploads.js

```JavaScript
const path = require('path');
const fs   = require('fs');
const { v4: uuidv4 } = require('uuid');
const { response } = require('express');
const { subirArchivo } = require('../helpers/subir-archivo');
```
> > Thunder client > POST > http://localhost:9090/api/uploads > form > files > 'archivos'
```json
{
    "nomArchivo":"470fc03f-92cc-4cad-800a-f696d4e676b2.jpeg"
}
```
> > Server.js

```JavaScript
const fileUpload = require('express-fileupload');


    middlewares() {
        this.app.use(cors());
        this.app.use(express.json());

        // Fileupload - Carga de archivos.
        this.app.use( fileUpload({
            useTempFiles : true,
            tempFileDir : '/tmp/',
            createParentPath: true  //Con esta opción si la carpeta de destino no existe, la crea.
        }));


        //Directorio públco: http://localhost:9090/  --> Habilitamos esto para ver como se cargaría una imagen desde el cliente.
        this.app.use(express.static('public'));
    }
```

## 5. MONGODB

MongoDB siempre es una excelente opción cuando se quieren realizar proyectos web apoyados en grandes conjuntos de datos sin estructurar. Sin estar atado a ningún esquema, el trabajo basado en documentos es el método ideal para gestionar un gran número de datos diferentes que deben ser almacenados y procesados rápidamente.

Así, la implementación de MongoDB resulta apropiada para casi todo tipo de proyectos web que quieran caracterizarse por:

- Escalabilidad: si tu proyecto web está en crecimiento, probablemente aumentará el número de visitas y solicitudes, lo que demanda una mayor capacidad de respuesta por parte de la base de datos.
- Disponibilidad: una de las prioridades de todo proyecto web es la disponibilidad en todo momento, incluso en el caso de fallos en el servidor.
- Flexibilidad: un proyecto debe poder ajustarse en cualquier momento de forma dinámica.
- Pero, si por otro lado, la estructura de los datos no suele cambiar con normalidad y el crecimiento de los datos es “moderado”, puede que las tecnologías SQL sean la mejor opción.
    
Las SQL.
- Mantenimiento difícil y costoso.
- Escalabilidad horizontal limitada, inapropiado para proyectos que crezcan mucho (alta escalabilidad).
- Poca flexibilidad a cambios.
- Elección de proveedor.
- Complejidad e instalación.


Resumen de comandos.

``` bash    
show dbs;      --> Muestra las bases de datos disponibles.
use basededatos;  --> Cambia la base de datos activa.
show collections; --> muestra las colecciones de la bd.
```

En la base de datos ejemplo:
``` bash
use ejemplo;
```

``` sql 
db.usuarios.insertOne({"id":1,"nombre":"JaimeR","edad":20})
db.usuarios.insertOne({"id":2,"nombre":"Inés","edad":21})
db.usuarios.insertMany([{"id":3,"nombre":"Francisco","edad":21},{"id":4,"nombre":"Badr","edad":22}])
db.usuarios.find().pretty() -- Lo muestra un poco más organizado.
db.usuarios.find({edad: 18 })
db.usuarios.find({edad: {$gte: 18} }) -- gte = greater than or equal
db.usuarios.find({edad: {$gt: 18} }) -- gt = greater than
db.usuarios.find({edad: {$gt: 18, $lt: 45} }) -- lt = less than


db.usuarios.updateOne({ id: 2 }, { $set: { nombre: "DAW2", edad: 18 } }) -- Actualiza el documento con id 2.
db.usuariosMongo.updateOne({id:1},{$set : {nombre: 'Elena', edad:22,roles: [ { id: 1, desc: 'Admin' },  { id: 2, desc: 'User' }]}})
db.usuarios.find({ /* tu condición de búsqueda */ }, { nombre: 1, edad: 1 }) --> Con esto mostramos los campos que hayamos seleccionado con 1.
db.usuarios.find({ /* tu condición de búsqueda */ }, { nombre: 0, edad: 0 }) --> Con esto excluimos esos campos de la consulta.
db.usuarios.find({},{"edad":1,"nombre":1,"_id":0}) -- Se pueden combinar. Esto hace una selección de todos pero solo de los campos con 1, sin incluir la id del documento.
db.usuarios.find().sort({id:1}) -- Con -1 el orden es descendente. Y 1 ascendente.
db.usuarios.find().sort({id:1}).limit(4) -- los 4 primeros.
db.usuarios.find({},{"edad":1,"nombre":1,"_id":0}).sort({edad:-1}).limit(3) -- Combinando un poco.
db.usuarios.count() -- Cuenta los documentos de la colección.

```
``` sql
db.usuarios.insertOne({
  id: 10,
  nombre: "Grijander",
  edad: 25,
  direccion: {
    calle: "123 Elm Street",
    ciudad: "Ghotham",
    codigoPostal: "12345"
  }
})  -- Inserta un documento anidado.
```

``` sql
db.usuarios.find({},{nombre:1,edad:1,_id:0,direccion:1})  -- Solo mostrará ese campo para el/los documentos que lo tengan.
db.usuarios.find({ "direccion.ciudad": "Ghotham" })  -- Consultas usando subcampos de documentos anidados.
db.usuarios.find({ $or: [ { edad: { $gte: 18, $lte: 20 } }, { "direccion.ciudad": "Ghotham" }] }, { nombre: 1, edad: 1, _id: 0, direccion: 1 })  //Consultas con $or. -- 

```

Consultas con condiciones:
``` sql
db.usuarios.find({"edad":{"$gt":"20","$lt":"30"}}); -- gt = greater than, lt = less than
db.usuarios.find({"edad": "$not":{"$gt":"20","$lt":"30"}}); -- not = not
db.usuarios.find({"pais":{"$in": ["Chile", "Argentina"]}}); -- in = in
```


Si tenemos la colección de comentarios:
```sql
db.comments.insertOne({idU:2, comment: "Me está fallando algo, puedes venir?", likes: 3, "timestamp": { $currentDate: { lastModified: true } } })
db.comments.insertOne({idU:2, comment: "Ya está, no vengas", likes: 2, "timestamp": { $currentDate: { lastModified: true } } })
db.comments.insertOne({idU:3, comment: "Tenemos que hacer el cliente?", likes: 27, "timestamp": { $currentDate: { lastModified: true } } })
db.comments.insertOne({idU:4, comment: "Pues el cliente tiene fallos de programación...", likes: 27, "timestamp": { $currentDate: { lastModified: true } } })

```


Para obtener los comentarios de los clientes tenemos que hacer una función aggregate:
```sql
db.usuarios.aggregate([ 
  {
    $lookup: { -- Esta función es la que nos permite "cruzar" documentos.
      from: "comments",
      localField: "id",
      foreignField: "idU",
      as: "comentarios"
    }
  },
  {
    $project: { -- la consulta en sí.
      _id: 0,
      id: 1,
      nombre: 1,
      comentarios: "$comentarios"
    }
  }
])

--un doble lookup: 
db.usuarios.aggregate([
  {
    $lookup: {
      from: "comments",
      localField: "id",
      foreignField: "idU",
      as: "comentarios"
    }
  },
  {
    $unwind: "$comentarios"
  },
  {
    $lookup: {
      from: "usuarios",
      localField: "comentarios.idU",
      foreignField: "id",
      as: "comentarios.usuario"
    }
  },
  {
    $project: {
      _id: 0,
      id: 1,
      nombre: 1,
      comentarios: "$comentarios"
    }
  }
]).pretty()
```

Roles y roles asignados. Si tenemos estas colecciones:
```sql
db.rolesasignados.find()
[
  { _id: ObjectId('65b6a4c23da5d020326198e0'), idU: 1, idR: 1 },
  { _id: ObjectId('65b6a4c43da5d020326198e1'), idU: 1, idR: 2 },
  { _id: ObjectId('65b6a4c83da5d020326198e2'), idU: 2, idR: 1 },
  { _id: ObjectId('65b6a4ce3da5d020326198e3'), idU: 3, idR: 2 },
  { _id: ObjectId('65b6a4d43da5d020326198e4'), idU: 4, idR: 3 },
  { _id: ObjectId('65b6a4d73da5d020326198e5'), idU: 4, idR: 2 },
  { _id: ObjectId('65b6a4d93da5d020326198e6'), idU: 4, idR: 1 },
  { _id: ObjectId('65b6a4e33da5d020326198e7'), idU: 18, idR: 2 },
  { _id: ObjectId('65b6a4e63da5d020326198e8'), idU: 19, idR: 2 },
  { _id: ObjectId('65b6a4ec3da5d020326198e9'), idU: 9, idR: 2 },
  { _id: ObjectId('65b6a4ef3da5d020326198ea'), idU: 10, idR: 2 }
]
```
```sql
db.roles.find()
[
  { _id: ObjectId('65b6a42c3da5d020326198dd'), id: 1, desc: 'Admin' },
  { _id: ObjectId('65b6a4353da5d020326198de'), id: 2, desc: 'User' },
  { _id: ObjectId('65b6a43f3da5d020326198df'), id: 3, desc: 'Guest' }
]
```

Una forma de "cruzar" documentos es usar una función aggregate como esta:
```sql
db.usuarios.aggregate([
  {
    $lookup: {
      from: "rolesasignados",
      localField: "id",
      foreignField: "idU",
      as: "roles_asignados"
    }
  },
  {
    $unwind: "$roles_asignados"
  },
  {
    $lookup: {
      from: "roles",
      localField: "roles_asignados.idR",
      foreignField: "id",
      as: "rol_info"
    }
  },
  {
    $project: {
      _id: 0,
      id: 1,
      nombre: 1,
      edad: 1,
      "rol_info.desc": 1,
      direccion: 1
    }
  }
]).pretty()
```


Tres Colecciones Separadas:

- Normalización: Este enfoque sigue el principio de normalización de bases de datos, donde la información se divide en tablas para evitar la redundancia y mejorar la consistencia de los datos.
- Flexibilidad: Permite cambios más fáciles en la información de roles y usuarios por separado.
- Mantenimiento: Es más sencillo realizar cambios en las colecciones independientes sin afectar otras partes del sistema.

Una Colección Única (Roles Incrustados o Array de Roles):

- Desnormalización: Puede simplificar las consultas al tener toda la información relacionada en un solo documento.
- Mejora en la Lectura: Si las consultas más comunes implican obtener la información completa de un usuario con sus roles, este enfoque podría mejorar el rendimiento al reducir la necesidad de unir varias colecciones.
- Menos Operaciones de Unión: Evitar el uso de $lookup puede ser beneficioso si la mayoría de las consultas no necesitan información de roles por separado.
- Consistencia Atomica: Al actualizar información en un solo documento, puedes garantizar que las operaciones sean atómicas y evitas problemas de consistencia entre colecciones.




Para insertar en un solo documento todo:
db.usuariosMongo.insertOne({id: 1, nombre: 'JaimeR', edad: 18, roles: [ { id: 1, desc: 'Admin' },  { id: 2, desc: 'User' }]})






Otros comandos:

db.usuarios.remove({id:2})  --> Borra el documento 2. Se pueden poner condiciones como en los find.
db.usuarios.update({id:2},{id:2,nombre:"Marina",edad:20}) --> Recordad que para modificar tenemos que incluir el nombre de todos los campos, además del que queremos modificar, para no perder nada.
db.usuarios.drop();  --> Borra la colección usuarios de la BD ejemplo.

use ejemplo;
db.dropDatabase(); --> Borra la base de datos ejemplo.



https://www.mongodbtutorial.org/mongodb-crud/mongodb-updateone/



Exportar/Importar
mongodump/mongorestore  --> Hace la copia de seguridad a la carpeta dump o de la carpeta dump desde donde se ejecute el comando.
Si queremos personalizar lo que se importa o exporta:
mongoexport
mongodump -d dbETW -c myCollection
mongorestore –host 127.51.12.1 –port 3017 /backup/mongodump-2013-01-01
mongorestore -d ejemplo -directoryperdb dump/ejemplo --drop

mongodump -h dbhost -d dbname -o dbdirectory





Definición de cursores:
var nuevoCursor=db.ejemplo.usuarios.find();
nuevoCursor.forEach(printjson)



En películas:
use peliculas;
db.pelis.insertOne({"titulo":"Dune","director":"Villeneuve"})
db.pelis.insertMany([{"titulo":"BladeRunner","director":"Villeneuve"},{"titulo":"El señor de los anillos","director":"Peter Jackson"}])
db.pelis.insertOne({"titulo":"Gattaca","director":"Andrew Niccol","edad":18})

db.pelis.find({director: {$in:["Villeneuve"] }})
db.pelis.find({director: {$in:["Villeneuve","Curtiz"] }})
db.directores.find();  --> Muestra todos los documentos de la colección directores de la bd ejemplo.

```bash
mongosh 
```
```bash


npm install mongoose
npm install mongodb

