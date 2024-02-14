package controller

import java.sql.SQLException
import BBDD.ConexionUsuarios
import io.ktor.http.*
import modelo.Respuesta
import modelo.Usuario

import utils.*


object UsuarioController {

    //inicio de sesión
    fun login(email: String, password: String): Respuesta {
        var respuesta: Respuesta
        try {
            val usuario = ConexionUsuarios.login(email, password)
            if (usuario != null) {
                respuesta = Respuesta("Inicio de sesión correcto", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("datos incorrectos", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }

    //cerrar sesión
    fun logout(token: String): Respuesta {
        var respuesta: Respuesta
        try {
            val cerrar = Revoked.revoked.remove(token)
            if (cerrar != null) {
                respuesta = Respuesta("Sesión cerrada", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Eror al cerrar sesión", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)

        }
        return respuesta
    }

    //todos los usuarios
    fun getUsuarios(): Respuesta {

        var respuesta: Respuesta
        try {
            val usuario = ConexionUsuarios.getUsuarios()
            if (usuario != null) {
                respuesta = Respuesta("Usuarios encontrados", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Usuarios no encontrado", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }

    //usuario por id
    fun getUsuario(id: Int): Respuesta {
        var respuesta: Respuesta
        try {
            val usuario = ConexionUsuarios.getUsuario(id)
            if (usuario != null) {
                respuesta = Respuesta("Usuario encontrado", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Usuario no encontrado", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }
        return respuesta
    }

    //registrar usuario
    fun registrar(usuario: Usuario): Respuesta {
        var respuesta: Respuesta
        try {
            val usuario = ConexionUsuarios.crearUsuario(usuario)

            if (usuario != null) {
                respuesta = Respuesta("Usuario registrad", HttpStatusCode.Created.value)
            } else {
                respuesta = Respuesta("Error al registrar al usuario", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }

        return respuesta
    }

    //modificar usuario
    fun modificarUsuario(usuario: Usuario): Respuesta {
        var respuesta: Respuesta
        try {
            val usuario = ConexionUsuarios.modificarUsuario(usuario)

            if (usuario != null) {
                respuesta = Respuesta("Usuario modificado", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Usuario no modificado", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }

        return respuesta
    }

    //borrar usuario
    fun borrarUsuario(id: Int): Respuesta {
        var respuesta: Respuesta
        try {
            val usuario = ConexionUsuarios.borrarUsuario(id)

            if (usuario != null) {
                respuesta = Respuesta("Usuario borrado", HttpStatusCode.OK.value)
            } else {
                respuesta = Respuesta("Usuario no borrado", HttpStatusCode.NotFound.value)
            }
        } catch (ex: SQLException) {
            respuesta = Respuesta("Error", HttpStatusCode.BadRequest.value)
        }

        return respuesta
    }
}