<?php

function json_response($status_code, $message, $data = ""){
    http_response_code($status_code);

    $array = [
        'status' => $status_code,
        'message' => $message,
    ];

    if($data != ""){
        $array['data'] = $data;
    }

    return $array;
}
?>