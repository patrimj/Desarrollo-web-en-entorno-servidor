package com.example

import com.auth0.jwt.JWT
import com.auth0.jwt.algorithms.Algorithm
import io.ktor.server.application.*
import io.ktor.server.engine.*
import io.ktor.server.netty.*
import com.example.plugins.*
import com.typesafe.config.ConfigFactory
import io.ktor.server.auth.*
import io.ktor.server.auth.jwt.*
import io.ktor.server.config.*
import utils.Parametros
import utils.TokenManager

fun main() {
    //val config = HoconApplicationConfig((ConfigFactory.load()))
//    embeddedServer(Netty, port = config.property("port").getString(), host = config.property("ip").getString(), module = Application::module)
    embeddedServer(Netty, port = Parametros.port, host = Parametros.ip, module = Application::module)
        .start(wait = true)
}

fun Application.module() {
//    val config = HoconApplicationConfig((ConfigFactory.load()))
//    val tokenManager = TokenManager(config)
    val tokenManager = TokenManager()

    configureSerialization()
    configureRouting()

    install(Authentication) {

       // jwt("auth-jwt") {
        jwt {
            verifier(tokenManager.verifyJWTToken())
            //Definimos la audiencia
            //realm = config.property("realm").getString()
            realm = Parametros.realm
            //Validamos el token
            validate {
                if (it.payload.getClaim("dni").asString().isNotEmpty()){
                    JWTPrincipal(it.payload)
                }
                else {
                    null
                }
            }
        }
    }
}
