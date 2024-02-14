package rutas

import io.ktor.server.application.*
import io.ktor.server.response.*
import io.ktor.server.routing.*
import controller.PruebaController
import io.ktor.server.request.*
import modelo.Prueba


fun Route.pruebaRouting() {
    route("/pruebas") {

        //Obtener todas las pruebas
        get {
            val pruebas = PruebaController.getPruebas()
            if (pruebas != null) {
                call.respond(pruebas)
            } else {
                call.respondText("No hay pruebas registradas")
            }
        }

        //completar una prueba
        put("/completar") {
            val id = call.parameters["id"]?.toIntOrNull() ?: return@put call.respondText(
                "id vacía en la url"
            )
            val prueba = PruebaController.completarPrueba(id)
            call.respond(prueba)
        }

        //crear una prueba
        post("/crear") {
            val prueba = call.receive<Prueba>()
            val respuesta = PruebaController.crearPrueba(prueba)
            call.respond(respuesta)
        }
    }

}