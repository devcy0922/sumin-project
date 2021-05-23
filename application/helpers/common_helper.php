<?php
function returnData($result = true, $data = [], $description = ""){
    return [
        "result" => $result,
        "data" => $data,
        "description" => $description,
    ];
}