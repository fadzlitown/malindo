<?php

namespace App\Controllers;

class ApiBaseController extends \Controller
{

    public $response    = [];
    public $http_status = 200;

    public function __construct()
    {
        $this->response = [
            'status' => '200',
            'error'  => false,
            'data'   => []
        ];
    }

    public function getErrorResponse($error_key, $http_status, $resources = "", $msg = "", $c_msg = "")
    {
        $response = array(
            'error'          => true, //true / false
            'message'        => '',
            'client_message' => '',
            'status'         => ''
        );

        $client_message = "";
        $message        = "";

        switch ($error_key) {
            case "credentialMissing":
                $message = "credential hasn't assigned or wrong";
                break;

            case "notFound":
                $message        = "Resources of {$resources} doesn't exists";
                $client_message = "The {$resources} doesn't exists. Please try again.";
                break;

            case "inputUnknown":
                $message        = "Input of {$resources} unknown";
                $client_message = "Your request cannot be proceed, due to unknown input. Please contact your site administrator.";
                break;

            case "errorValidator":
                $message        = $msg;
                $client_message = $c_msg;
                break;

            case "noResults":
                $message        = "No results available.";
                $client_message = "No results available in the moment. Please try again later.";
                break;

            default:
                break;
        }

        $response['message']        = $message;
        $response['client_message'] = $client_message;
        $response['status']         = $http_status;
        $this->http_status          = $http_status;

        return $response;
    }

}
