package utils

object Parametros {
    val ip = "192.168.1.56"
    val port = 8080
    val secret = "algo"
    val issuer = "http://$ip:$port"
    val audience = "http://$ip:$port/rutasVarias"
    val realm = "Access to 'rutasVarias'"
}