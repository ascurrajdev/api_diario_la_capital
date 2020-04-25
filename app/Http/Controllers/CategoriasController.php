<?php
namespace App\Http\Controllers;
use App\Categoria;
use App\Http\Resources\CategoriasCollection;
use App\Http\Resources\Json\CategoriasJson;
class CategoriasController extends Controller{
    public function __construct(){}

    /**   @OA\Get(
    *        path="/api/categorias",
    *        tags={"Categorias"},
    *        @OA\Response(
    *            response="200",
    *            description="Retorna todas las categorias de noticias existentes",
    *            @OA\JsonContent()
    *        ),
    *    )
    */
    public function index(){
        return new CategoriasCollection(Categoria::all());
    }
    /**
     *     @OA\Get(
     *          path="/api/categorias/{id}",
     *          tags={"Categorias"},
     *          @OA\Parameter(
     *              name="id",
     *              in="path",
     *              description="En este parametro introducimos la id de la categoria a mostrar",
     *              required=true,
     *              @OA\Schema(type="string"),
     *          ),
     *          @OA\Response(
     *              response="200",
     *              description="Retorna la categoria filtrada por el id",
     *              @OA\JsonContent(),
     *          ),
     *          @OA\Response(
     *              response="400",
     *              description="No se especifico el id",
     *              @OA\JsonContent(),
     *          ),
     *      )
     */
    public function show($id){
        if($id){
            return new CategoriasJson(Categoria::findOrFail($id));
        }else{
            return response()->json([
                "message" => "Por favor introduzca el id de la categoria"
            ],401);
        }
    }
}