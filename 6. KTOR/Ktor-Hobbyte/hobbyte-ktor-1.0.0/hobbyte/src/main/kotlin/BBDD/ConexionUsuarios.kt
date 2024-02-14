package BBDD

import java.sql.*

import BBDD.ConexionEstatica.abrirConexion
import BBDD.ConexionEstatica.cerrarConexion

import modelo.Usuario
import modelo.Login

object ConexionUsuarios {

    //inicio de sesión
    fun login(email: String, password: String): Login? {
        var usuario: Login? = null
        try {
            abrirConexion()
            val sentencia = "SELECT * FROM " + Constantes.TablaUsuarios + " WHERE email = ? AND password = ?"
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)

            pstmt.setString(1, email)
            pstmt.setString(2, password)
            ConexionEstatica.registros = pstmt.executeQuery()

            while (ConexionEstatica.registros!!.next()) {
                usuario = Login(
                    ConexionEstatica.registros!!.getString("email"),
                    ConexionEstatica.registros!!.getString("password")
                )
            }
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return usuario
    }

    //todos los usuarios
    fun getUsuarios(): ArrayList<Usuario> {
        var usuario = ArrayList<Usuario>()
        try {
            abrirConexion()
            val sentencia = "SELECT * FROM " + Constantes.TablaUsuarios
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)

            ConexionEstatica.registros = pstmt.executeQuery()
            while (ConexionEstatica.registros!!.next()) {
                Usuario(
                    ConexionEstatica.registros!!.getInt("id"),
                    ConexionEstatica.registros!!.getString("nombre"),
                    ConexionEstatica.registros!!.getString("apellido"),
                    ConexionEstatica.registros!!.getString("email"),
                    ConexionEstatica.registros!!.getString("password")
                )
            }
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return usuario
    }

    //usuario por id
    fun getUsuario(id: Int): Usuario? {
        var usuario: Usuario? = null
        try {
            abrirConexion()
            val sentencia = "SELECT * FROM " + Constantes.TablaUsuarios + " WHERE id = ?"
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)

            pstmt.setInt(1, id)
            ConexionEstatica.registros = pstmt.executeQuery()
            while (ConexionEstatica.registros!!.next()) {
                usuario = Usuario(
                    ConexionEstatica.registros!!.getInt("id"),
                    ConexionEstatica.registros!!.getString("nombre"),
                    ConexionEstatica.registros!!.getString("apellido"),
                    ConexionEstatica.registros!!.getString("email"),
                    ConexionEstatica.registros!!.getString("password")
                )
            }
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return usuario
    }

    //crear usuario
    fun crearUsuario(usuario: Usuario): Usuario? {

        var usuarioCreado: Usuario? = null

        val sentencia =
            "INSERT INTO " + Constantes.TablaUsuarios + " (nombre, apellido, email, password) VALUES (?, ?, ?, ?)"
        try {
            abrirConexion()
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            pstmt.setString(1, usuario.nombre)
            pstmt.setString(2, usuario.apellido)
            pstmt.setString(3, usuario.email)
            pstmt.setString(4, usuario.password)
            pstmt.executeUpdate()
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return usuarioCreado
    }

    //TODO:COD O USUARIO ??¿??

    //modificar usuario
    fun modificarUsuario(usuario: Usuario): Int {
        var cod = 0
        val sentencia =
            "UPDATE " + Constantes.TablaUsuarios + " SET nombre = ?, apellido = ?, email = ?, password = ? WHERE id = ?"
        try {
            abrirConexion()
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            pstmt.setString(1, usuario.nombre)
            pstmt.setString(2, usuario.apellido)
            pstmt.setString(3, usuario.email)
            pstmt.setString(4, usuario.password)
            pstmt.setInt(5, usuario.id)
            pstmt.executeUpdate()
        } catch (ex: SQLException) {
            cod = ex.errorCode
        } finally {
            cerrarConexion()
        }
        return cod
    }

    //borrar usuario
    fun borrarUsuario(id: Int): Int {
        var cuantos =
            0 /// el cuantos hace referencia a la cantidad de registros afectados, esto sirve para saber si se ha borrado o no
        val sentencia = "DELETE FROM " + Constantes.TablaUsuarios + " WHERE id = ?"
        try {
            abrirConexion()
            val pstmt = ConexionEstatica.conexion!!.prepareStatement(sentencia)
            pstmt.setInt(1, id)
            cuantos = pstmt.executeUpdate()
        } catch (ex: SQLException) {
        } finally {
            cerrarConexion()
        }
        return cuantos
    }
}

