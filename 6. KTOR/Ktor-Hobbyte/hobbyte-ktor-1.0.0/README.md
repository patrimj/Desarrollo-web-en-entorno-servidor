# El hobbyte - Ktor

- [Patricia Mota](https://github.com/patrimj)


Vamos a realizar un jueguecillo sobre El Hobbit. Consiste en lo siguiente:
- Tenemos tres personajes: Gandalf, Thorin y Bilbo. Gandalf puede hacer las pruebas de magia, Thorin las de fuerza y Bilbo las de habilidad. Los tres parten con una capacidad máxima respectiva de 50. Estos datos están inicialmente en la base de datos. No hará falta hacer un CRUD de ellos.
- Se genera un tablero de 20 casillas en las que habrá escondidas 20 pruebas (una por casilla). Las pruebas pueden ser de los 3 tipos (magia, fuerza o habilidad) y la cantidad de esfuerzo necesario para lograrla. Esta cantidad de esfuerzo serán los siguientes números posibles: 5, 10, 15, 20, 25, 30, 35, 40, 45 y 50. Estas pruebas también están ya en la base de datos pero debemos dar la posibilidad de generar con factorías una cantidad determinada de ellas.
- Una vez generado el tablero (los tableros), comienza el juego. Consiste en destapar casillas y realizar las pruebas (por el héroe correspondiente y si le queda poder) de forma que:
  - Si el poder del héroe es mayor que el necesario para realizar la prueba se logra la prueba al 90 %.
  -Si es igual se logra al 70%. 
  - Si es menor se consigue al 50%. 
  - Si no se logra, ese héroe pierde toda su capacidad y quedará inactivo. 
  - Si se logra pierde la capacidad necesaria para lograr la prueba (se
  resta). 
  - Si al héroe no le quedara poder para afrontar la prueba se debe dar
   por perdida. 
  - Ganamos cuando hemos logrado destapar la mitad de las casillas y vive, al
  menos, un héroe. 
  - Perdemos si nos quedamos sin héroes o si hemos destapado 5 casillas
  seguidas perdiendo.

# USUARIOS

#### Iniciar sesión

- URL: `http://192.168.1.56:8080/usuarios/login`
- Método: `POST`
- Datos requeridos:
  - `email`: Email del usuario (string, requerido)
  - `password`: Contraseña del usuario (string, requerido)

##### Ejemplo de solicitud para iniciar sesión
```json
{
  "email": "patrimj@gmail.com",
  "password": "admin123"
}
```

#### Obtener todos los usuarios

- URL: `http://192.168.1.56:8080/usuarios`
- Método: `GET`

#### Obtener usuario por ID

- URL: `http://192.168.1.56:8080/usuarios/{id}`
- Método: `GET`
- Datos requeridos:
  - `id`: ID del usuario (integer, requerido)

#### Crear usuario

- URL: `http://192.168.1.56:8080/usuarios`
- Método: `POST`
- Datos requeridos:
  - `nombre`: Nombre del usuario (string, requerido)
  - `apellido`: Apellido del usuario (string, requerido)
  - `email`: Email del usuario (string, requerido, único)
  - `password`: Contraseña del usuario (string, requerido)

##### Ejemplo de solicitud para crear usuario
```json
{
  "nombre": "Patricia",
  "apellido": "Mota",
  "email": "patrimj@gmail.com",
  "password": "admin123"
}
```

#### Modificar usuario

- URL: `http://192.168.1.56:8080/usuarios/{id}`
- Método: `PUT`
- Datos requeridos:
  - `id`: ID del usuario (integer, requerido)
  - `nombre`: Nombre del usuario (string, requerido)
  - `apellido`: Apellido del usuario (string, requerido)
  - `email`: Email del usuario (string, requerido, único)
  - `password`: Contraseña del usuario (string, requerido)

##### Ejemplo de solicitud para modificar usuario
```json
{
  "nombre": "Patri",
  "apellido": "Mota",
  "email": "patrimj@gmail.com",
  "password": "admin123"
}
```

#### Borrar usuario

- URL: `http://192.168.1.56:8080/usuarios/{id}`
- Método: `DELETE`
- Datos requeridos:
  - `id`: ID del usuario (integer, requerido)

# HEROES

#### Obtener todos los heroes
- URL: `http://192.168.1.56:8080/heroes`
- Método: `GET`

#### Obtener heroe por ID
- URL: `http://192.168.1.56:8080/heroes/{id}`
- Método: `GET`
- Datos requeridos:
  - `id`: ID del usuario (integer, requerido)

#### Crear héroe

- URL: `http://192.168.1.56:8080/heroes/crear`
- Método: `POST`
- Datos requeridos:
  - `nombre`: Nombre del héroe (string, requerido)
  - `tipo`: Tipo del héroe (string, requerido)
  - `max_capacidad`: Capacidad máxima del héroe (integer, requerido)
  - `capacidad_actual`: Capacidad actual del héroe (integer, requerido)

##### Ejemplo de solicitud para crear héroe
```json
{
  "nombre": "Superman",
  "tipo": "fuerza",
  "max_capacidad": 50,
  "capacidad_actual": 50
}
```

#### Modificar capacidad actual de un héroe
- URL: http://192.168.1.56:8080/heroes/capacidad/{id}
- Método: PUT
- Datos requeridos:
  - id: ID del héroe (integer, requerido)
  - capacidad_actual: Nueva capacidad actual del héroe (integer, requerido)

##### Ejemplo de solicitud para modificar capacidad actual de un héroe

```json
{
  "capacidad_actual": 25
}
```
# PRUEBAS

#### Obtener todas las pruebas

- URL: `http://192.168.1.56:8080/pruebas`
- Método: `GET`

#### Completar prueba

- URL: `http://192.168.1.56:8080/pruebas/completar/{id}`
- Método: `PUT`
- Datos requeridos:
  - `id`: ID de la prueba (integer, requerido)

#### Crear prueba

- URL: `http://192.168.1.56:8080/pruebas/crear`
- Método: `POST`
- Datos requeridos:
  - `tipo`: Tipo de la prueba (string, requerido)
  - `esfuerzo`: Esfuerzo requerido para la prueba (integer, requerido)
  - `completada`: Estado de la prueba (boolean, requerido)

##### Ejemplo de solicitud para crear prueba
```json
{
  "tipo": "Física",
  "esfuerzo": 50,
  "completada": false
}
```
# PARTIDAS

#### Obtener todas las partidas

- URL: `http://192.168.1.56:8080/partidas`
- Método: `GET`

#### Obtener una partida por ID

- URL: `http://192.168.1.56:8080/partidas/{id}`
- Método: `GET`
- Datos requeridos:
  - `id`: ID de la partida (integer, requerido)

#### Obtener partidas de un usuario

- URL: `http://192.168.1.56:8080/partidas/usuario/{id_usuario}`
- Método: `GET`
- Datos requeridos:
  - `id_usuario`: ID del usuario (integer, requerido)

#### Crear partida

- URL: `http://192.168.1.56:8080/partida/crear/{id_usuario}`
- Método: `POST`
- Datos requeridos:
  - `id_usuario`: ID del usuario (integer, requerido)

#### Completar una partida

- URL: `http://192.168.1.56:8080/partida/terminar/{id}`
- Método: `PUT`
- Datos requeridos:
  - `id`: ID de la partida (integer, requerido)

# CASILLAS

#### Obtener todas las casillas de una partida

- URL: `http://192.168.1.56:8080/casillas/{id_partida}`
- Método: `GET`
- Datos requeridos:
  - `id_partida`: ID de la partida (integer, requerido)

#### Obtener una casilla específica de una partida

- URL: `http://192.168.1.56:8080/casillas/{id_partida}/{id_casilla}`
- Método: `GET`
- Datos requeridos:
  - `id_partida`: ID de la partida (integer, requerido)
  - `id_casilla`: ID de la casilla (integer, requerido)

#### Modificar una casilla de una partida

- URL: `http://192.168.1.56:8080/casillas/modificar/{id_partida}/{id_casilla}`
- Método: `PUT`
- Datos requeridos:
  - `id_partida`: ID de la partida (integer, requerido)
  - `id_casilla`: ID de la casilla (integer, requerido)
  - `casilla`: Datos de la casilla a modificar (object, requerido)

#### Completar una casilla de una partida

- URL: `http://192.168.1.56:8080/casillas/completar/{id_partida}/{id_casilla}`
- Método: `PUT`
- Datos requeridos:
  - `id_partida`: ID de la partida (integer, requerido)
  - `id_casilla`: ID de la casilla (integer, requerido)

#### Obtener una casilla aleatoria de una partida

- URL: `http://192.168.1.56:8080/casillas/aleatoria/{id_partida}`
- Método: `GET`
- Datos requeridos:
  - `id_partida`: ID de la partida (integer, requerido)

# Base de Datos

## Tabla `users`

| `id` | `nombre` | `apellidos` | `email`                 | `email_verified_at` | `password`              | `remember_token` | `created_at` | `updated_at` |
|------|----------|-------------|-------------------------|---------------------|-------------------------|------------------|--------------|--------------|
| 1    | 'nombre' | 'apellido'  | 'patrimj@gmail.com.com' | '2022-01-01 00:00:00' | 'contraseña encriptada' | 'token' | '2022-01-01 00:00:00' | '2022-01-01 00:00:00' |

## Tabla `heroes`

| `id` | `nombre` | `tipo` | `max_capacidad` | `capacidad_actual` | `created_at` | `updated_at` |
|------|----------|-------|-----------------|--------------------|--------------|--------------|
| 1    | 'nombre' | 'Fuerza' | 50              | 20                 | '2022-01-01 00:00:00' | '2022-01-01 00:00:00' |

## Tabla `pruebas`

| `id` | `tipo` | `esfuerzo` | `completada` | `created_at` | `updated_at` |
|------|-------|------------|--------------|--------------|--------------|
| 1    | 'Física' | 50 | 0 | '2022-01-01 00:00:00' | '2022-01-01 00:00:00' |

## Tabla `partidas`

| `id` | `id_usuario` | `estado` | `casillas_destapadas` | `heroes_vivos` | `created_at` | `updated_at` |
|------|--------------|----------|-----------------------|----------------|--------------|--------------|
| 1    | 1 | 0 | 0 | 3 | '2022-01-01 00:00:00' | '2022-01-01 00:00:00' |

## Tabla `casillas`

| `id` | `id_prueba` | `id_heroe` | `id_partida` | `estado` | `created_at` | `updated_at` |
|------|-------------|------------|--------------|----------|--------------|--------------|
| 1    | 1 | 1 | 1 | 0 | '2022-01-01 00:00:00' | '2022-01-01 00:00:00' |
