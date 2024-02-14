package rutas

import controller.UsuarioController
import io.ktor.http.*
import io.ktor.server.application.*
import io.ktor.server.auth.*
import io.ktor.server.auth.jwt.*
import io.ktor.server.request.*
import io.ktor.server.response.*
import io.ktor.server.routing.*
import modelo.Login
import modelo.Usuario
import modelo.Respuesta
import utils.TokenManager
import utils.RevokeTokenRequest


fun Route.userRouting() {
    val tokenManager = TokenManager()

    route("/usuarios") {

        get {
            val usuarios = UsuarioController.getUsuarios()
            if (usuarios != null) {
                call.respond(usuarios)
            } else {
                call.respondText("No hay usuarios registrados", status = HttpStatusCode.NotFound)
            }
        }

        get("{id}") {
            val id = call.parameters["id"]?.toIntOrNull() ?: return@get call.respondText(
                "id vacío en la url",
                status = HttpStatusCode.BadRequest
            )
            val usuarios = UsuarioController.getUsuario(id)

            if (usuarios != null) {
                call.respond(usuarios)
            } else {
                call.response.status(HttpStatusCode.NotFound)
                return@get call.respond(Respuesta("Usuario ${id} no encontrado", HttpStatusCode.NotFound.value))
            }
        }
        post {
            val usuario = call.receive<Usuario>()
            val respuesta = UsuarioController.registrar(usuario)
            call.respond(respuesta)
        }
        put {
            val usuario = call.receive<Usuario>()
            val respuesta = UsuarioController.modificarUsuario(usuario)
            call.respond(respuesta)
        }
    }

    route("/login") {
        post {
            val login = call.receive<Login>()
            val respuesta = UsuarioController.login(login.email, login.password)

            if (respuesta == null) {
                call.response.status(HttpStatusCode.NotFound)
                return@post call.respond(
                    Respuesta(
                        "Usuario ${login.email} email incorrecto",
                        HttpStatusCode.NotFound.value
                    )
                )
            }

            val token = tokenManager.generateJWTToken(login)
            call.respond(mapOf("token" to token, "email" to login.email))
        }
    }

    route("/logout") {
        get {
            val revokeTokenRequest = call.receive<RevokeTokenRequest>()
            val token = revokeTokenRequest.token
            val respuesta = UsuarioController.logout(token)
            call.respond(respuesta)
        }
    }

    route("/registrar") {
        post {
            val usuario = call.receive<Usuario>()
            val respuesta = UsuarioController.registrar(usuario)
            call.respond(respuesta)
        }

    }
    route("/borrar") {
        authenticate {
            delete("{id?}") {
                val principal = call.principal<JWTPrincipal>()
                var idSolicitante = principal!!.payload.getClaim("id").toString()

                idSolicitante = idSolicitante.replace("\"", "")
                var usuarios = UsuarioController.getUsuarios()
                val respuesta = UsuarioController.borrarUsuario(idSolicitante.toInt())

                if (respuesta != null) {
                    val id = call.parameters["id"] ?: return@delete call.respondText(
                        "id vacío en la url",
                        status = HttpStatusCode.BadRequest
                    )
                    if (id == idSolicitante) {
                        call.respond(respuesta)
                    } else {
                        call.response.status(HttpStatusCode.NotFound)
                        return@delete call.respond(
                            Respuesta(
                                "Usuario ${id} no puede ser borrado",
                                HttpStatusCode.NotFound.value
                            )
                        )
                    }
                }
            }
        }
    }
}