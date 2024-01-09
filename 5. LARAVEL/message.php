namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parte;
use Illuminate\Support\Facades\Validator;

class ParteController extends Controller
{
    public function index()
    {
        $partes = Parte::all();
        return response()->json($partes, 200);
    }


    public function store(Request $request)
    {
        $input = $request->all();

        $messages = [
            'required' => 'Campo obligatorio',
            'gravedad' => [
                'in' => 'El campo :gravedad debe estar entre las siguientes opciones: :Leve,Destierro,Pasar por la quilla',
            ],
            'causa' => [
                'in' => 'El campo :causa debe ser uno de los siguientes valores: :Nada,Todo',
            ],
        ];

        $validator = Validator::make($input, [
            'nombre' => 'required',
            'causa' => 'required | in :Nada,Todo',
            'gravedad' => 'required | in: :Leve,Destierro,Pasar por la quilla'
            // 'observaciones' => 'required | string | max:255'
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 202);
        }

        $parte = Parte::create($input);
        return response()->json(["success" => true, "data" => $parte, "message" => "Created"]);
    }


    public function show($id)
    {
        $parte = Parte::find($id);
        if (is_null($parte)) {
            return response()->json("Parte no encontrado", 202);
        }
        return response()->json(["success" => true, "data" => $parte, "message" => "Retrieved"]);
    }


    public function update($id, Request $request)
    {
        $input = $request->all();

        /* $validator = Validator::make($input, [
            'nombre' => 'required',
            'causa' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json("Error en los datos", 204);
        } */

        $parte = Parte::find($id);
        $parte->nombre = $input['nombre'];
        $parte->causa = $input['causa'];
        $parte->save();

        return response()->json(["success" => true, "data" => $parte, "message" => "Updated"]);
    }

    public function destroy($id)
    {
        $parte = Parte::find($id);
        $parte->delete();
        return response()->json(["success" => true, "data" => $parte, "message" => "Deleted"]);
    }
}
