<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;




class AuthController extends Controller
{
public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ // compara correo y contraseña con la base de datos
            $auth = Auth::user(); // si todo es correcto me devuelve el usuario tdo incluido el token
            //return $auth;


            //cuando su rol es admin le damos todos los permisos y cuando es un usuario normal solo lectura
            if($auth->rol == "admin"){
                $success['token'] =  $auth->createToken('access_token',["create","read","modify","delete"])->plainTextToken;
            }
            else{
                $success['token'] =  $auth->createToken('access_token',["lectura"])->plainTextToken;
            }
            
            $success['token'] =  $auth->createToken('LaravelSanctumAuth')->plainTextToken; // creo el token nuevo para cada conexion
            //$success['token'] =  $auth->createToken('access_token',["lectura"])->plainTextToken;
            $success['name'] =  $auth->name;

            return response()->json(["success"=>true,"data"=>$success, "message" => "User logged-in!"]);
        }
        else{
            return response()->json("Unauthorised",204);
        }
    }

    public function register(Request $request)
    {
        //validator muy util para validar los datos que nos llegan

        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'email' => 'El campo :attribute debe ser un email válido.',
            'unique' => 'El campo :attribute ya existe en la base de datos.',
            'same' => 'El campo :attribute y :other deben coincidir.',
            'numeric' => 'El campo :attribute debe ser un número.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'between' => 'El campo :attribute debe estar entre :min y :max.',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20', // es el que voy a poner en el body
            'email' => 'required|email|max:255|unique:users', //Con esto evitamos que ocurra el error de la clave duplicada.
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'edad' => 'numeric|integer|between:18,90'
        ], $messages);

        if($validator->fails()){
            return response()->json($validator->errors(),202);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['name'] =  $user->name;

            //$success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
            $success['token'] =  $user->createToken('access_token',["lectura"])->plainTextToken;
            //$success['token'] =  $user->createToken('access_token',["create","read"])->plainTextToken;
            //$success['token'] =  $user->createToken('access_token',["create","read","modify"])->plainTextToken;


        //va a devolver el token y el nombre del usuario
        return response()->json(["success"=>true,"data"=>$success, "message" => "User successfully registered!"]);
    }
/*         

http://127.0.0.1:8000/api/register --> POST

{
"name":"carlos", 
"email":"carlos@gmail.com", 
"password":"1234"
}

ME DEVUELVE 
  {
  "success": true,
  "data": {
    "token": "1|uPIIEBNWtg0S1gFdw4Ltxx8nV1wWnXMXS5j0GMH46175fb8b",
    "name": "carlos"
  },
  "message": "User successfully registered!"
}

     /**
     * Por defecto los tokens de Sanctum no expiran. Se puede modificar esto añadiendo una cantidad en minutos a la variable 'expiration' en el archivo de config/sanctum.php.
     */
     public function logout(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $cantidad = Auth::user()->tokens()->delete();
            return response()->json(["success"=>true, "message" => "Tokens Revoked: ".$cantidad],200);
        }
        else {
            return response()->json("Unauthorised",204);
        }

    }
    
}