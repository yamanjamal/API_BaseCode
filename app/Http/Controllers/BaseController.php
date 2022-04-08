<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
   public function sendResponse($result , $message)
   {
       $response = [
        'success' => true,
        'data' => $result,
        'message' => $message
       ];
       return response()->json($response , 200,[],JSON_UNESCAPED_SLASHES);
   }

   public function sendError($error , $errorMessage=[] , $code = 404)
   {
       $response = [
        'success' => false,
        'data' => $error
       ];
       if (!empty($errorMessage)) {
        $response['data'] = $errorMessage;
       }
       return response()->json($response , $code,[],JSON_UNESCAPED_SLASHES);
   }
}
