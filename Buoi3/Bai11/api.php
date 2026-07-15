<?php
header('Content-Type: application/json');

$apiUrl = "https://open.er-api.com/v6/latest/USD";
$response = @file_get_contents($apiUrl);

if ($response !== false) {
    echo $response;
} else {
    //thong bao loi
    echo json_encode(["error" => "Không thể lấy dữ liệu từ API."]);
}
?>