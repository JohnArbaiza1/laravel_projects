<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class studentController extends Controller
{
    public function index(){
        //retorna una lista con un arreglo de datos
         //Student::all();
         $student = Student::all();

        //Verificamos si el arreglo esta vacio
       if($student->isEmpty()){
           /* Forma 1
            $data = [
                'message' => 'No se encontraron datos :(',
                'status' => '200'
            ];
            return response()->json($data, 404);*/

            $datos = [
                'mensaje' => 'No se encontraron datos',
                'mensaje2' => $student,
                'status' => '200'
            ];

            return response()->json($datos, 404);
       }
         $data = [
            'message' => 'Datos de estudiantes',
             'student' => $student,
         ];

          return response()->json($data,200);

    }

    public function store(Request $request){
        //cuando se recibe un dado lo validamos

        //Arreglo de datos a validar
        $validator = Validator::make($request -> all(),[
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:8',
            'grado' => 'required'
        ]);

        //Verificamo si hay un error en la validacion
        if($validator -> fails()){
            $data = [
                'message1' => 'Error en la validacion de datos',
                'message' => $validator->errors(),
                'status' => '200'
            ];
            return response()->json($data, 400);
        }

        //Si los datos son correctos y no hubo ningun error
        //en el modulo student voy a estar creando algo
        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request-> phone,
            'grado' => $request->grado

        ]);
        //verificamos si se pudo crear el estudiante
        if(!$student){
            $data = [
                'message1' => 'Error al crear dato de estudiante',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'student' => $student,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    //para buscar estudiantes
    public function show($id){
        $student = Student::find($id);

        //verificamos si se encontro al estudiante
        if(!$student){
            $data = [
                'message1' => 'Estudiante no encontrado',
                'status' => 404
                ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => 'Datos de estudiantes',
             'student' => $student,
         ];

          return response()->json($data,200);
    }

    //Para eliminar los estudiantes
    public function destroy($id){
        $student = Student::find($id);

        //verificamos si se encontro al estudiante
        if(!$student){
             $data = [
                'message1' => 'Estudiante no encontrado',
                'status' => 404
                 ];
                return response()->json($data, 404);
            }

            $student->delete($id);
            $data = [
                'message' => 'Estudiante Eliminado',
                'status' => 200
            ];

        return response()->json($data,200);
    }

        //Para actualizar el dato
        public function update(Request $request, $id){

            //Buscamos al estudiante
            $student = Student::find($id);

            if(!$student){
                $data =[
                'message1' => 'Estudiante no encontrado',
                'status' => 404
                 ];
                return response()->json($data, 404);
            }

            //Arreglo de datos a validar
            $validator = Validator::make($request -> all(),[
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|digits:8',
                    'grado' => 'required'
            ]);

            //verificamos que la validacion se ejecuto de manera correcta
            if($validator->fails()){
                    $data = [
                        'message1' => 'Error en la validacion de datos',
                        'errors' => $validator->errors(),
                        'status' => 400
                    ];
                return response()->json($data, 400);
            }

            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->grado = $request->grado;

            $student->save();

            $data = [
                'message1' => 'Datos actualizados',
                'student' => $student,
                'status' => 200
            ];

            return response()->json($data, 200);

        }

        public function updatePartial(Request $request, $id){
            //Buscamos al estudiante
            $student = Student::find($id);

            if(!$student){
                 $data =[
                    'message1' => 'Estudiante no encontrado',
                    'status' => 404
                ];
                return response()->json($data, 404);
            }

            return response()->json($request->all(), 200);

                            //Arreglo de datos a validar
            $validator = Validator::make($request -> all(),[
                'name' => '',
                'email' => 'email',
                'phone' => 'digits:8',
                'grado' => ''
            ]);

             //verificamos que la validacion se ejecuto de manera correcta
            if($validator->fails()){
                $data = [
                        'message1' => 'Error en la validacion de datos',
                        'errors' => $validator->errors(),
                        'status' => 400
                ];
                return response()->json($data, 400);
            }

            if($request->has('name')){
                $student->name = $request->name;
            }

            if($request->has('email')){
                $student->email = $request->email;
            }

            if($request->has('phone')){
                $student->phone = $request->phone;
            }

            if($request->has('grado')){
                $student->grado = $request->grado;
            }

            $student->save();

            $data = [
                'message1' => 'Datos actualizados',
                'student' => $student,
                'status' => 200
            ];

            return response()->json($data, 200);

        }

}
