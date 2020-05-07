<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use App\Http\Resources\EncuestaCollection;
use App\Encuesta;
use App\Respuesta;
use Illuminate\Http\Request;
use App\Http\Resources\Json\EncuestaJson;

class EncuestaController extends Controller{
    public function __construct(){}

    /**
     * @OA\Get(
     *      path="/api/encuestas",
     *      tags={"Encuestas"},
     *      @OA\Response(
     *          response="200",
     *          description="Obtiene todas las encuestas en formato json",
     *          @OA\JsonContent(),
     *      ),
     * ),
     */
    public function index(){
        $ip = "127.0.0.1";
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];}
         elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
         } else {
            $ip = $_SERVER['REMOTE_ADDR'];
         }
        $arrayExceptEncuestas = data_get(Respuesta::select('encuesta_id')->where('ip_cliente',$ip)->get(),'*.encuesta_id');
        
        return new EncuestaCollection(Encuesta::take(10)->orderBy('id','desc')->get()->except($arrayExceptEncuestas));
    }

    /**
     * @OA\Get(
     *      path="/api/encuestas/{id}",
     *      tags={"Encuestas"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="La id unica de la encuesta a visualizar",
     *          @OA\Schema(type="string",),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Obtiene la encuesta fitrada por el id",
     *          @OA\JsonContent(),
     *      ),
     * ),
     */
    public function show($id){
        return new EncuestaJson(Encuesta::findOrFail($id));
    }
    /**
     * @OA\Post(
     *      path="/api/encuestas/{id}",
     *      tags={"Encuestas"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="La id unica de la encuesta a registrar la nueva respuesta",
     *          @OA\Schema(type="string"),
     *      ),
     *      @OA\Parameter(
     *          name="opcion",
     *          in="query",
     *          description="La opcion de la encuesta que elige el usuario",
     *          @OA\Schema(type="string"),
     *      ),
     *      @OA\Parameter(
     *          name="comentario",
     *          in="query",
     *          description="El comentario que realiza de acuerdo a la opcion elegida por el usuario",
     *          @OA\Schema(type="string"),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Devuelve la respuesta realizada en formato json",
     *          @OA\JsonContent(),
     *      ),
     * ),
     */
    public function nuevaRespuesta(Request $request,$id){
        $respuesta = new Respuesta;
        $respuesta->id = null;
        $respuesta->encuesta_id = $id;
        $respuesta->opcion_id = $request->input('opcion');
        $respuesta->comentario = $request->input('comentario');
        $respuesta->ip_cliente = $request->ip;
        $respuesta->save();
        return $respuesta;
    }
}