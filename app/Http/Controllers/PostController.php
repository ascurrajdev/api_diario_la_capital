<?php
namespace App\Http\Controllers;
use App\Categoria;
use App\Country;
use App\Http\Resources\Json\PostsJson;
use App\Http\Resources\PostsCategoriaCollection;
use App\Http\Resources\PostsCollection;
use App\Post;
use App\Vista;
use Victorybiz\GeoIPLocation\GeoIPLocation;

class PostController extends Controller {
	public function __contruct() {}

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
	public function index() {
		//return CategoriasJson::collection(Categoria::all());
		return new PostsCollection(Post::orderBy('id', 'desc')->take(5)->get());
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
	public function show($id) {
		$ip = "127.0.0.1";
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		if ($ip == "127.0.0.1") {
			$ip = "201.44.81.39";
		}
		$geoip = new GeoIPLocation();
		$geoip->setIP($ip);
		$idCountry = (Country::where('code', $geoip->getCountryCode())->first())->id;
		$post = Post::findOrFail($id);
		$vistas = new Vista;
		$vistas->id = null;
		$vistas->post_id = $id;
		$vistas->ip_cliente = $ip;
		$vistas->pais_id = $idCountry;
		$vistas->save();
		return new PostsJson($post);
	}
	/**
	 * @OA\Get(
	 *      path="/api/posts/categoria/{idCategoria}",
	 *      tags={"Noticias"},
	 *      @OA\Parameter(
	 *          name="idCategoria",
	 *          in="path",
	 *          description="La id de la categoria de las noticias a mostrar",
	 *          required=true,
	 *          @OA\Schema(type="string"),
	 *      ),
	 *      @OA\Response(
	 *          response="200",
	 *          description="Retorna todas las noticias filtradas por el id de la categoria",
	 *          @OA\JsonContent(),
	 *          ),
	 * )
	 */

	public function showByCategory($idCategoria) {
		$post = Post::where('categoria_id', $idCategoria)->orderBy('id', 'desc')->paginate(5);
		return new PostsCategoriaCollection($post);
	}

}
