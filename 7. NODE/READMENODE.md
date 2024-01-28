# Comandos utiles para Node

## Inicializacion de node
```bash
npm init -y
```

## Instalación de la librería express
```bash
npm install express
```

## Instalación de la librería nodemon, utilidad para que se reinicie el servidor cada vez que se modifique un archivo
```bash
npm install -g nodemon
npm install --save-dev nodemon
```
- Para iniciar el servidor con nodemon
```bash
nodemon app
nodemon
```
- En thunder Cliente
http://localhost:9090/api/personas


## Para crear el archivo ``.env``
```bash
npm install dotenv --save
```

## Para generar la carpeta ``node_modules``
```bash
npm install
```

## Para instalar la dependencia ``cors``
```bash
npm install cors
```

## Para instalar ``mysql``
```bash
npm install mysql2
```

## En el archivo situado en /app/server.js, para evitar problemas de ``cors``
```bash
middlewares() {
    this.app.use(cors());
}
```

## Estructura de carpetas estandar
- ``app``
- ``models``
- ``controllers``
- ``middlewares``
- ``routes``
- ``migrations``
- ``seeds``
- ``database``
  - ``conexion.js``
  - ``Factories``
    - una factoria por cada modelo y por cada tabla

## Para instalar ``validator`` 
```bash
npm install validator
npm install express-validator
```
- Las validaciones de los datos se hacen en el archivo ``/routes``)
- Ejemplo de validacion de datos en el archivo ``/app/routes/personas.js``
```javascript
.isInt({min: 1, max: 5})
```

## Para instalar ``jsonwebtoken``, para generar tokens
```bash
npm install jsonwebtoken
```
- en .env
```bash
SECRETORPRIVATEKEY=eST0EsmiPiblic@key
```

## Para instalar ``Faker``, para generar datos aleatorios
```bash
npm i @faker-js/faker
```

# Sequelize
- Documentación oficial: https://sequelize.org/docs/v6/getting-started/

## Para instalar las dependecias de ``sequelize``
```bash
npm install --save sequelize
npm install sequelize sqlite3

``` 
## Para definir ``modelos``
```bash
import { Sequelize, DataTypes } from 'sequelize';

const sequelize = new Sequelize('sqlite::memory:');
const User = sequelize.define('User', {
  username: DataTypes.STRING,
  birthday: DataTypes.DATE,
});
```

# Migrations
- Documentación oficial: https://sequelize.org/master/manual/migrations.html

## Para instalar las dependecias de ``migrations``
```bash
npm install --save-dev sequelize-cli

```
```bash
npx sequelize-cli init
```

## Configuración
 ``config/config.json``
 ```json
 {
  "development": {
    "username": "root",
    "password": null,
    "database": "database_development",
    "host": "127.0.0.1",
    "dialect": "mysql"
  },
  "test": {
    "username": "root",
    "password": null,
    "database": "database_test",
    "host": "127.0.0.1",
    "dialect": "mysql"
  },
  "production": {
    "username": "root",
    "password": null,
    "database": "database_production",
    "host": "127.0.0.1",
    "dialect": "mysql"
  }
}
```
## Para crear un ``modelo`` - ``migration``
```bash
npx sequelize-cli model:generate --name User --attributes firstName:string,lastName:string,email:stringº
```

## Crear ``Factories``
La factoria las debemos crear a manita

## bycript para encriptar las contraseñas
```bash
npm install bcrypt
```


