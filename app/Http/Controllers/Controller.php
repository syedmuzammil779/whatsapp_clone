<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

abstract class Controller
{
    //

    protected function validateFields($request, $data, $customMessages = []){
        $validator = Validator::make($request->all(), $data, $customMessages);



        if ($validator->fails()) {

            foreach (array_values($validator->errors()->toArray()) as $error) {
                foreach ($error as $arr) {
                    $response = array('code'=> 0,'message'=>__($arr));
                    echo json_encode($response);
                    die();
                }
            }
        }

        return true;
    }

    public function isAuthenticated(){


        if( session()->has('user_token') ){
            return true;
        }
        return false;

    }

    protected function filledRequestFields($request, $fields, $currentObject){
        foreach ($fields as $parameter) {

            if( $request->filled('id') && $request->id > 0 ){

                if( $request->has( $parameter ) ) {
                    $currentObject->$parameter = $request->$parameter;
                }

            } else if( $request->filled($parameter) ) {
                $currentObject->$parameter = $request->$parameter;

            }
        }
    }

    protected function generateRandomString(){

        return substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,6);
    }
    protected function generateRandomCode(){

        return $code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    protected function preparePagination($request){

        $limit = $request->per_page;
        $page = $request->has('page') &&  $request->page > 0 ? $request->page:1;
        $limit_start = (int)($page-1)* $limit;

        return [$page,$limit,$limit_start];
    }

    protected function checkObjectExist($object, $message) {

        if( ! isset( $object )) {
            $response = array('code'=> 2,'message'=>$message);
            echo json_encode($response);
            die();
        }

    }

    protected function checkObjectArrayOrString($array) {


        if( ! is_array($array)) {
            $array = json_decode( $array, true );  // arr['íd']
        }

        return $array;

    }

    protected function jsonEncodeMessage($code,$message="success",$data=[]) {

        return response()->json(["code"=>$code,'message'=>__($message), 'data' =>$data]);

    }

    protected function safeJson( $json ){

        $new_json = $json;
        try {
            if ( gettype( $json ) === 'array' ) {
                unset( $new_json['password'] );
            }

        } catch (\Exception $ex) {
            info('Safe json encode exception ==== '. $ex->getMessage());
        }
        return json_encode($new_json);

    }
}
