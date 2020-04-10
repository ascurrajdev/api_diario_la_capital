<?php
namespace App\Http\Controllers;
use App\Http\Resources\VistasCollection;
use App\Vista;
class VistaController extends Controller{
    public function __construct(){}

    /**
     * @OA\Get(
     *      path="/api/vistas",
     *      tags={"Visitas"},
     *      @OA\Response(
     *          response="200",
     *          description="Obtiene todas las visitas",
     *          @OA\JsonContent(),
     *      ),
     * ),
     */
    public function index(){
        return new VistasCollection(Vista::all());
    }
}