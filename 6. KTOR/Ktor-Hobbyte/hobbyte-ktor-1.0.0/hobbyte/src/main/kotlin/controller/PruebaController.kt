package controller

import java.sql.SQLException
import BBDD.ConexionPruebas
import io.ktor.http.*
import modelo.Respuesta
import modelo.Prueba


object PruebaController {

    //lisa de todas las pruebas
    fun getPruebas(): Respuesta {

        var respuesta: Respuesta
        try {
            val prueba = ConexionPruebas.getPruebas()
            if (prueba != null) {
                respuesta = Respuesta("Pruebas", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Pruebas no encontradas", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }

    //completar una prueba
    fun completarPrueba(id: Int): Respuesta {

        var respuesta: Respuesta
        try {
            val prueba = ConexionPruebas.completarPrueba(id)
            if (prueba) {
                respuesta = Respuesta("Prueba completada", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Prueba no completada", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }

    fun crearPrueba(prueba: Prueba): Respuesta {

        var respuesta: Respuesta
        try {
            val prueba = ConexionPruebas.crearPrueba(prueba)
            if (prueba != null) {
                respuesta = Respuesta("Prueba creada", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Prueba no creada", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }
}