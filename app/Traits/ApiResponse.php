<?php
namespace App\Traits;
use Illuminate\Http\Response;
trait ApiResponse{
    public function successResponse($message,$code = Response::HTTP_OK){
        return response()->json(["data"=> $message,"code"=>$code],$code);
    }
    public function errorResponse($message, $code){
        return response()->json([
            "error"=>$message,
            "code" => $code
        ],$code);
    }

}