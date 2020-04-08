<?php

namespace App\Http\Controllers;


class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * @OA\Delete(
     *     path="/operaciones/{category}/productos",
     *     operationId="/sample/category/things",
     *     tags={"Acciones"},
     *     @OA\Parameter(
     *         name="category",
     *         in="path",
     *         description="Especificamos la categoria del producto que queremos visualizar",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="criteria",
     *         in="query",
     *         description="Some optional other parameter",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Returns some sample category things",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */
    public function index(){

    }
}
