package controller

import java.sql.SQLException
import BBDD.ConexionPartidas
import io.ktor.http.*
import modelo.Respuesta

object PartidaController {

    //todas las partidas
    fun getPartidas(): Respuesta {
        var respuesta: Respuesta
        try {
            val partida = ConexionPartidas.getPartidas()
            if (partida != null) {
                respuesta = Respuesta("Partidas encontrrdas", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Partida no encontrada", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }

    //partidas de un usuario
    fun getPartidasUsuario(id_usuario: Int): Respuesta {
        var respuesta: Respuesta
        try {
            val partida = ConexionPartidas.getPartidasUsuario(id_usuario)
            if (partida != null) {
                respuesta = Respuesta("Partida del usuario encontrada", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Partida dek usuario no encontrada", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }

    //partida específica
    fun getPartida(id: Int): Respuesta {
        var respuesta: Respuesta
        try {
            val partida = ConexionPartidas.getPartida(id)
            if (partida != null) {
                respuesta = Respuesta("Partida encontrada", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Partida no encontrada", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }

    //terminar partida
    fun completarPartida(id: Int): Respuesta {
        var respuesta: Respuesta
        try {
            val partida = ConexionPartidas.completarPartida(id)
            if (partida != null) {
                respuesta = Respuesta("Partida completada", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Partida no completada", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }

    //crear partida
    fun crearPruebasPartida(id_usuario: Int): Respuesta {
        var respuesta: Respuesta

        try {
            val partida = ConexionPartidas.crearPartida(id_usuario)
            if (partida != null) {
                respuesta = Respuesta("Partida creada", HttpStatusCode.Created.value)
            } else {
                respuesta = Respuesta("Partida no cread", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }


}