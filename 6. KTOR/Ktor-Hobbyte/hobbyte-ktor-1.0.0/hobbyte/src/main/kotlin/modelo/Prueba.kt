package modelo

import kotlinx.serialization.Serializable

@Serializable
data class Prueba (
    val id:Int,
    val tipo:String,
    val esfuerzo:Int,
    val completada:Boolean
    ){

}
