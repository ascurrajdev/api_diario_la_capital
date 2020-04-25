<?php
namespace App\Http\Controllers;
use App\Post;
use App\Vista;
use App\Categoria;
use App\Http\Resources\Json\CategoriasJson;
use App\Http\Resources\PostsCollection;
use App\Http\Resources\Json\PostsJson;
use App\Country;
class PostController extends Controller{
    public function __contruct(){}

    /**
     * @OA\Get(
     *      path="/api/posts",
     *      tags={"Noticias"},
     *      @OA\Response(
     *          response="200",
     *           description="Se obtienen todas las noticias del dia en un formato json",
     *            @OA\JsonContent(),
     *        ) 
     * ),
     */
    public function index(){
        //return CategoriasJson::collection(Categoria::all());
        return new PostsCollection(Post::orderBy('id','desc')->take(5)->get());
    }

    /**
     * @OA\Get(
     *      path="/api/posts/{id}",
     *      tags={"Noticias"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="La id unica de la noticia a visualizar",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              ),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Obtiene en formato json la noticia",
     *          @OA\JsonContent(),
     *      ),
     * )
     */
    public function show($id){
        $vistas = new Vista;
        $vistas->id=null;
        $vistas->post_id=$id;
        $vistas->ip_cliente=$_SERVER['REMOTE_ADDR'];
        $vistas->pais_id=1;
        $vistas->save();
        return new PostsJson(Post::find($id));
    }
}