<?php
/**
 * Created by PhpStorm.
 * User: wheatleyjj
 * Date: 11/01/2018
 * Time: 22:45
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class APIInterface extends Controller
{
    protected function APIResponse($success = true, $error = null, $data = null, $status = null) {
        if($success && !$status) {
            $status = 204;
        } else if(!$success && !$status) {
            if(is_null($error)) {
                $status = 500;
            } else {
                $status = 400;
            }
        }
        return response()->json([
            'success' => $success,
            'error' => $error,
            'data' => $data
        ], !$status ? 500 : $status)->setStatusCode($status);
    }
}