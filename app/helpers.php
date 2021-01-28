<?php
use Illuminate\Support\Facades\Http;

    // function test() {
    //     $url = env('URL_SERVICE_USER').'/users/';
    //     var_dump($url);
    // }

    function getUser($userId) {
        $url = env('URL_SERVICE_USER').'users/'.$userId;

        try {
            $response = Http::timeout(10)->get($url);
            $data = $response->json();
            $data['http_code'] = $response->getStatusCode();
            return $data;
        } catch (\Throwable $th) {
            return [
                'status' => 'error',
                'http_code' => 500,
                'message' => 'SERVICE USER UNAVAILABLE'
            ];
        }
    }

    function getUserByIds($userIds = []) {
        $url = env('URL_SERVICE_USER').'users/';

        try {
            if (count($userIds) === 0) {
                return [
                    'status' => 'SUKSES',
                    'http_code' => 200,
                    'data' => []
                ];
            }

            $response = Http::timeout(10)->get($url, ['user_ids[]' => $userIds]);
            $data = $response->json();
            $data['http_code'] = $response->getStatusCode();
            return $data;
        } catch (\Throwable $th) {
            return [
                'status' => 'error',
                'http_code' => 500,
                'message' => 'SERVICE USER UNAVAILABLE'
            ];
        }
    }

    function postOrder($params) {
        $url = env('URL_SERVICE_ORDER').'api/orders';

        try {
            $response = Http::post($url, $params);
            $data = $response->json();
            $data['http_code'] = $response->getStatusCode();
            return $data;
        } catch (\Throwable $th) {
            return [
                'status' => 'error',
                'http_code' => 500,
                'message' => 'SERVICE ORDERS UNAVAILABLE'
            ];
        }
    }

?>