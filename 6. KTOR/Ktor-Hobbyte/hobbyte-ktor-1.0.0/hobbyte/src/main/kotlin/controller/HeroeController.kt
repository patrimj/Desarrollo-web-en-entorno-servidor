package controller

import java.sql.SQLException
import BBDD.ConexionHeroes
import io.ktor.http.*
import modelo.Respuesta
import modelo.Heroe


object HeroeController {

    //lista de heroes
    fun getHeroes(): Respuesta {
        var respuesta: Respuesta
        try {
            val heroe = ConexionHeroes.getHeroes()
            if (heroe != null) {
                respuesta = Respuesta("Heroe encontrado", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Heroe no encontrado", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }

    //heroe por id
    fun getHeroe(id: Int): Respuesta {
        var respuesta: Respuesta
        try {
            val heroe = ConexionHeroes.getHeroe(id)
            if (heroe != null) {
                respuesta = Respuesta("Heroe encontrado", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Heroe no encontrado", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }

    //crear heroe
    fun crearHeroe(heroe: Heroe): Respuesta {
        var respuesta: Respuesta
        try {
            val heroe = ConexionHeroes.crearHeroe(heroe)
            if (heroe != null) {
                respuesta = Respuesta("Heroe cread", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Heroe no creado", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }

    ////modificar capacidad
    fun modificarCapacidad(id: Int, capacidad_actual: Int): Respuesta {
        var respuesta: Respuesta
        try {
            val heroe = ConexionHeroes.modificarCapacidad(id, capacidad_actual)
            if (heroe != null) {
                respuesta = Respuesta("Capacidad modificada", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Capacidad no modificada", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }

}