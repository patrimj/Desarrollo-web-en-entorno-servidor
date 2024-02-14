package rutas

import io.ktor.http.*
import io.ktor.server.application.*
import io.ktor.server.request.*
import io.ktor.server.response.*
import io.ktor.server.routing.*
import controller.HeroeController
import modelo.Heroe
import modelo.Respuesta


fun Route.heroeRouting() {

    route("/heroes") {

        //lista de heroes
        get {
            val heroes = HeroeController.getHeroes()
            if (heroes != null) {
                call.respond(heroes)
            } else {
                call.respondText("No hay heroes registrados", status = HttpStatusCode.NotFound)
            }
        }

        ////heroe por id
        get("{id}") {
            val id = call.parameters["id"]?.toIntOrNull() ?: return@get call.respondText(
                "id vacío en la url",
                status = HttpStatusCode.BadRequest
            )
            val heroes = HeroeController.getHeroe(id)

            if (heroes != null) {
                call.respond(heroes)
            } else {
                call.response.status(HttpStatusCode.NotFound)
                return@get call.respond(Respuesta("Heroe ${id} no encontrado", HttpStatusCode.NotFound.value))
            }
        }

        //crear heroe
        post("/crear") {
            val heroe = call.receive<Heroe>()
            val respuesta = HeroeController.crearHeroe(heroe)
            call.respond(respuesta)
        }

        //modificar capacidad
        put("capacidad/{id}") {
            val id = call.parameters["id"]?.toIntOrNull() ?: return@put call.respondText(
                "id vacío en la url",
                status = HttpStatusCode.BadRequest
            )
            val capacidad_actual = call.parameters["capacidad_actual"]?.toIntOrNull() ?: return@put call.respondText(
                "capacidad_actual vacío en la url",
                status = HttpStatusCode.BadRequest
            )
            val respuesta = HeroeController.modificarCapacidad(id, capacidad_actual)
            call.respond(respuesta)
        }
    }

}