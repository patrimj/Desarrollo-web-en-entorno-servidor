package rutas

import io.ktor.server.application.*
import io.ktor.server.response.*
import io.ktor.server.routing.*
import controller.PartidaController
import io.ktor.server.request.*
import modelo.Partida

fun Route.partidaRouting() {
    route("/partidas") {

        //Obtener todas las partidas
        get {
            val partidas = PartidaController.getPartidas()
            if (partidas != null) {
                call.respond(partidas)
            } else {
                call.respondText("No hay partidas registradas")
            }
        }
        //Obtener una partida específica
        get("/{id}") {
            val id = call.parameters["id"]?.toIntOrNull() ?: return@get call.respondText(
                "id vacíaen la url"
            )
            val partida = PartidaController.getPartida(id)
            call.respond(partida)
        }

        //Obtener todas las partidas de un usuario
        get("/usuario/{id_usuario}") {
            val id_usuario = call.parameters["id_usuario"]?.toIntOrNull() ?: return@get call.respondText(
                "id vacía en la url"
            )
            val partida = PartidaController.getPartidasUsuario(id_usuario)
            call.respond(partida)
        }

        route("/partida/crear/{id_usuario}") {
            //Crear una partida
            post {
                val id_usuario = call.parameters["id_usuario"]?.toIntOrNull() ?: return@post call.respondText(
                    "id vacía en la url"
                )
                val respuesta = PartidaController.crearPruebasPartida(id_usuario)

                call.respond(respuesta)
            }

            //terminar una partida
            put("/terminar/{id}") {
                val id = call.parameters["id"]?.toIntOrNull() ?: return@put call.respondText(
                    "id vacía en la url"
                )
                val partida = call.receive<Partida>()
                val respuesta = PartidaController.completarPartida(id)
                call.respond(respuesta)
            }
        }

    }
}