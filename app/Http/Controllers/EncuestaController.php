<?php 

namespace App\Http\Controllers;
use App\Http\Resources\EncuestaCollection;
use App\Encuesta;
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
        return new EncuestaCollection(Encuesta::all());
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
        return new EncuestaJson(Encuesta::find($id));
    }
}