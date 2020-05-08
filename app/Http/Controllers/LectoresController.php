<?php
namespace App\Http\Controllers;
use App\Events\LectorCreadoEvent;
use App\Lector;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LectoresController extends Controller {
	use ApiResponse;

	/**
	 * @OA\Post(
	 *      path="/api/lector",
	 *      tags={"Lectores"},
	 *      @OA\Parameter(
	 *          name="nombre",
	 *          in="query",
	 *          description="Indica el nombre del lector",
	 *          @OA\Schema(type="string"),
	 *      ),
	 *      @OA\Parameter(
	 *          name="apellido",
	 *          in="query",
	 *          description="Indica el apellido del lector",
	 *          @OA\Schema(type="string"),
	 *      ),
	 *      @OA\Parameter(
	 *          name="email",
	 *          in="query",
	 *          description="Indica el correo del lector",
	 *          @OA\Schema(type="email"),
	 *      ),
	 *      @OA\Parameter(
	 *          name="cedula",
	 *          in="query",
	 *          description="Indica la cedula de identidad del lector",
	 *          @OA\Schema(type="string"),
	 *      ),
	 *      @OA\Response(
	 *          response="200",
	 *          description="Retorna el lector registrado en formato json",
	 *          @OA\JsonContent(),
	 *      ),
	 * )
	 */
	public function store(Request $request) {
		$this->validate($request, [
			"nombre" => "required|max:255",
			"apellido" => "required|max:255",
			"email" => "required|email:rfc,dns",
			"cedula" => "required|max:255",
		]);
		$lector = new Lector;
		$lector->id = null;
		$lector->nombre_completo = $request->input("nombre") . " " . $request->input("apellido");
		$lector->correo = $request->input("email");
		$lector->cedula = $request->input("cedula");
		$lector->save();
		event(new LectorCreadoEvent($lector));
		return $this->successResponse($lector, Response::HTTP_CREATED);
	}
}
