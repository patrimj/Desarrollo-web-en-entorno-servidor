package rutas

import io.ktor.http.*
import io.ktor.server.application.*
import io.ktor.server.response.*
import io.ktor.server.routing.*
import controller.CasillaController
import io.ktor.server.request.*
import modelo.Casilla


fun Route.casillaRouting() {
    route("/casillas") {

        //Obtener todas las casillas de una partida
        get("{id_partida}") {
            val id_partida = call.parameters["id_partida"]?.toIntOrNull() ?: return@get call.respondText(
                "id vacío en la url",
                status = HttpStatusCode.BadRequest
            )
            val casillas = CasillaController.getCasillasPartida(id_partida)
            if (casillas != null) {
                call.respond(casillas)
            } else {
                call.respondText("No hay casillas registradas", status = HttpStatusCode.NotFound)
            }
        }

        //Obtener una casilla específica de una partida
        get("{id_partida}/{id_casilla}") {
            val id_partida = call.parameters["id_partida"]?.toIntOrNull() ?: return@get call.respondText(
                "id vacío en la url",
                status = HttpStatusCode.BadRequest
            )
            val id_casilla = call.parameters["id_casilla"]?.toIntOrNull() ?: return@get call.respondText(
                "id vacío en la url",
                status = HttpStatusCode.BadRequest
            )
            val casilla = CasillaController.getCasillaPartida(id_partida, id_casilla)
            if (casilla != null) {
                call.respond(casilla)
            } else {
                call.respondText("No hay casillas registradas", status = HttpStatusCode.NotFound)
            }
        }

        ///Modificar una casilla de una partida
        put("{modificar/id_partida}/{id_casilla}") {
            val id_casilla = call.parameters["id_casilla"]?.toIntOrNull() ?: return@put call.respondText(
                "id vacío en la url",
                status = HttpStatusCode.BadRequest
            )
            val casilla = call.receive<Casilla>()
            val respuesta = CasillaController.modificarCasilla(casilla)
            call.respond(respuesta)
        }

        //Completar una casilla de una partida
        put("{completar/id_partida}/{id_casilla}") {
            val id_casilla = call.parameters["id_casilla"]?.toIntOrNull() ?: return@put call.respondText(
                "id vacío en la url",
                status = HttpStatusCode.BadRequest
            )
            val respuesta = CasillaController.completarCasilla(id_casilla)
            call.respond(respuesta)
        }

        //Obtener una casilla aleatoria de una partida
        get("{aleatoria/id_partida}") {
            val id_partida = call.parameters["id_partida"]?.toIntOrNull() ?: return@get call.respondText(
                "id vacío en la url",
                status = HttpStatusCode.BadRequest
            )
            val casillas = CasillaController.getCasillaAleatoria(id_partida)
            if (casillas != null) {
                call.respond(casillas)
            } else {
                call.respondText("No hay casillas registradas", status = HttpStatusCode.NotFound)
            }
        }
    }

}