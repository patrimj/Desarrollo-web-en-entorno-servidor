package com.example

import com.example.plugins.*
import io.ktor.server.application.*
import io.ktor.server.engine.*
import io.ktor.server.netty.*

fun main() {
    embeddedServer(Netty, port = 8080, host = "0.0.0.0", module = Application::module)
        //poner la ip montada en el hsot 192.268.206.240
            .start(wait = true)
}

fun Application.module() {
    configureSerialization()
    configureRouting()
}
