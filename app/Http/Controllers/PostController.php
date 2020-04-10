<?php
namespace App\Http\Controllers;
use App\Post;
use App\Vista;
use App\Http\Resources\PostsCollection;
use App\Http\Resources\Json\PostsJson;
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
        return new PostsCollection(Post::all());
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