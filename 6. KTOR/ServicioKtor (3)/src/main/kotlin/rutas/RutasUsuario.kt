package rutas

import com.auth0.jwt.JWT
import com.auth0.jwt.algorithms.Algorithm
import com.typesafe.config.ConfigFactory
import io.ktor.http.*
import io.ktor.server.application.*
import io.ktor.server.auth.*
import io.ktor.server.auth.jwt.*
import io.ktor.server.config.*
import io.ktor.server.request.*
import io.ktor.server.response.*
import io.ktor.server.routing.*
import modelo.Body2String
import modelo.Respuesta
import modelo.Usuario
import modelo.UsuarioLogin
import utils.RevokeTokenRequest
import utils.Revoked
import utils.TokenManager
import java.util.*
import java.util.stream.Stream
import kotlin.streams.toList

var rolesAdmin = arrayListOf<String>("admin","user")
var rolesUser = arrayListOf<String>("user")
private val usuarios = arrayListOf<Usuario>(
    Usuario("1A", "DAM2", "1234","555 454554", rolesAdmin),
    Usuario("2B", "DAW2", "1234","555 897999", rolesUser),
    Usuario("3C", "DAW1", "1234","555 234564", rolesUser),
    Usuario("4D", "DAM1", "1234","555 233456", rolesUser)
)

fun Route.userRouting(){  //Esta ruta se incluirá en el archivo Routing.
//    val tokenManager = TokenManager(HoconApplicationConfig((ConfigFactory.load())))
    val tokenManager = TokenManager()
    route("/listado") {
//            authenticate {
            get {
                if (usuarios.isNotEmpty()) {
                    call.respond(usuarios)
                } else {
                    call.respond(Respuesta("No hay usuarios",HttpStatusCode.OK.value))
                }
            }
//            }

        get("{dni?}") {
            val dni = call.parameters["dni"] ?: return@get call.respondText(
                "id vacío en la url",
                status = HttpStatusCode.BadRequest
            )

            try {
                val pruebaParam = dni.toString()
            } catch (e: Exception) {
                call.response.status(HttpStatusCode.BadRequest)
                return@get call.respond(Respuesta("Parámetro ${dni} no válido", HttpStatusCode.BadRequest.value))
            }
            val usuario = usuarios.find { it.dni == dni }
            if (usuario == null) {
                call.response.status(HttpStatusCode.NotFound)
                return@get call.respond(Respuesta("Usuario ${dni} no encontrado", HttpStatusCode.NotFound.value))
                //call.respondText("Usuario ${id} no encontrado", status = HttpStatusCode.NotFound)
            }
            call.respond(usuario)
        }
        post{
            val us = call.receive<Body2String>()
            println(us)
            println(us.valores.get("cad1"))
            println(us.valores.get("cad2"))
            call.respond(us)
        }
    }
    route("/login") {
        post{
            val us = call.receive<UsuarioLogin>()
            val usuario = usuarios.find { it.dni == us.dni && it.clave == us.clave }
            if (usuario == null) {
                call.response.status(HttpStatusCode.NotFound)
                return@post call.respond(Respuesta("Usuario ${us.dni} login incorrecto", HttpStatusCode.NotFound.value))
                //call.respondText("Usuario ${id} no encontrado", status = HttpStatusCode.NotFound)
            }
            val token = tokenManager.generateJWTToken(usuario)
            call.respond(mapOf("token" to token, "dni" to usuario.dni))
        }
    }
    route("/logout") {
        get{
            val revokeTokenRequest = call.receive<RevokeTokenRequest>()
            val token = revokeTokenRequest.token
            Revoked.revoked.add(token)
            call.respond(HttpStatusCode.OK,"Logout con exito")
        }
    }
    route("/registrar") {
        post{
            val us = call.receive<Usuario>()
            usuarios.add(us)
            call.respond(Respuesta("Usuario creado",HttpStatusCode.Created.value))
        }
    }
    //Protegememos la ruta
    route("/borrar") {
        authenticate {
            delete("{dni?}") {
                val principal = call.principal<JWTPrincipal>()
                var dniSolicitante = principal!!.payload.getClaim("dni").toString()
                println(dniSolicitante)
                //call.respond(mapOf("dniDueToken" to dniSolicitante, "dniBorrar" to call.parameters["dni"]))
                dniSolicitante = dniSolicitante.replace("\"","") //Lo guarda como "1A" le quitamos las comillas.
                //call.respond(mapOf("dniDueToken" to dniSolicitante, "dniBorrar" to call.parameters["dni"]))
                var usSolicitante = usuarios.find {  it.dni  ==  dniSolicitante && it.roles.contains("admin")}
                //call.respondText (usSolicitante.toString())
                if(usSolicitante != null){
                    val dni = call.parameters["dni"] ?: return@delete call.respondText("id vacío en la url", status = HttpStatusCode.BadRequest)
                    if (usuarios.removeIf { it.dni == dni }){
                        call.respond(mapOf("message" to "Usuario eliminado", "dni" to dniSolicitante))
                    }
                    else {
                        call.respond(Respuesta("No encontrado",HttpStatusCode.NotFound.value))
                    }
                }
                else {
                    call.respond(Respuesta("Tu rol no lo autoriza",HttpStatusCode.NotFound.value))
                }
            }
        }
    }
    route("/modificar") {
        put("{dni?}") {
            val dni = call.parameters["dni"] ?: return@put call.respondText("id vacío en la url", status = HttpStatusCode.BadRequest)
            val us = call.receive<Usuario>()
            val pos = usuarios.indexOfFirst{ it.dni == dni}
            if (pos == -1){
                call.respond(Respuesta("No encontrado",HttpStatusCode.NotFound.value))
            }
            else {
                usuarios[pos] = us
                call.respond(Respuesta("Usuario modificado",HttpStatusCode.Accepted.value))
            }
        }
    }


}
