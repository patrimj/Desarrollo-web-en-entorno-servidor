package controller

import java.sql.SQLException
import io.ktor.http.*
import modelo.Respuesta
import BBDD.ConexionCasillas
import modelo.Casilla


object CasillaController {

    //Obtener todas las casillas de una partida
    fun getCasillasPartida(id_partida: Int): Respuesta {
        var respuesta: Respuesta
        try {
            val casillas = ConexionCasillas.getCasillasPartida(id_partida)
            if (casillas != null) {
                respuesta = Respuesta("Casillas encontradas", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Casillas no encontradas", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }

    //Obtener una casilla específica de una partida
    fun getCasillaPartida(id_partida: Int, id_casilla: Int): Respuesta {
        var respuesta: Respuesta
        try {
            val casilla = ConexionCasillas.getCasillaPartida(id_partida, id_casilla)
            if (casilla != null) {
                respuesta = Respuesta("Casilla encontrada", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Casilla no encontrada", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }

    //Completar una casilla de una partida
    fun completarCasilla(id_casilla: Int): Respuesta {
        var respuesta: Respuesta
        try {
            val completada = ConexionCasillas.completarCasilla(id_casilla)
            if (completada) {
                respuesta = Respuesta("Casilla completada", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Casilla no completada", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }

    //Modificar una casilla de una partida
    fun modificarCasilla(casilla: Casilla): Respuesta {
        var respuesta: Respuesta
        try {

            val modificada = ConexionCasillas.modificarCasilla(casilla)

            if (modificada != null) {
                respuesta = Respuesta("Casilla modificada", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Casilla no modificada", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }

    //Obtener una casilla aleatoria de una partida
    fun getCasillaAleatoria(id_partida: Int): Respuesta {
        var respuesta: Respuesta
        try {
            val casilla = ConexionCasillas.getCasillaAleatoria(id_partida)
            if (casilla != null) {
                respuesta = Respuesta("Casilla aleatoria encontrada", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Casilla aleatoria no encontrada", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }
}