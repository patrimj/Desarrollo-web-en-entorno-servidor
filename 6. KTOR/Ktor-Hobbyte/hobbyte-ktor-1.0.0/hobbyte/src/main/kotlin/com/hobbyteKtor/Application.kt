package com.hobbyteKtor

import com.hobbyteKtor.plugins.configureRouting
import com.hobbyteKtor.plugins.configureSerialization
import io.ktor.server.application.*
import io.ktor.server.engine.*
import io.ktor.server.netty.*

import io.ktor.server.auth.*
import io.ktor.server.auth.jwt.*

import utils.Parametros
import utils.TokenManager

fun main() {
    embeddedServer(
        Netty,
        port = Parametros.port,
        host = Parametros.ip,
        module = Application::module
    )
        .start(wait = true)
}

fun Application.module() {
    val tokenManager = TokenManager()

    configureSerialization()
    configureRouting()

    install(Authentication) {

        jwt {
            verifier(tokenManager.verifyJWTToken())
            realm = Parametros.realm
            //Validamos el token
            validate {
                if (it.payload.getClaim("email").asString().isNotEmpty()) {
                    JWTPrincipal(it.payload)
                } else {
                    null
                }
            }
        }
    }
}
