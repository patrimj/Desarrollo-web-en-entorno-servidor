package modelo

import kotlinx.serialization.Serializable
//RESPUESTA JSON QUE SE ENVIA AL CLIENTE
@Serializable
data class Respuesta(val message:String, val status:Int){


}
