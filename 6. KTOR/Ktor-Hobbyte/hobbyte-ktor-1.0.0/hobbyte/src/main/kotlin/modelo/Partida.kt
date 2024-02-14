package modelo

import kotlinx.serialization.Serializable

@Serializable
data class Partida (
    val id:Int,
    val id_usuario:Int,
    val estado:Boolean,
    val casillas_destapadas:Int,
    val heroes_vivos:Int,
    ){


}