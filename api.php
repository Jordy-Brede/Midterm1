<?php
require_once __DIR__ . '/../controllers/QuoteController.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$uri = explode("/", trim($_SERVER["REQUEST_URI"], "/"));

$controller = new QuoteController();

if ($uri[0] === "quotes") {
    switch ($requestMethod) {
        case "POST":
            $controller->createQuote();
            break;
        case "PUT":
            $controller->updateQuote();
            break;
        case "DELETE":
            $controller->deleteQuote();
            break;
        default:
            echo json_encode(["message" => "Method Not Allowed"]);
            http_response_code(405);
            break;
    }
} else {
    echo json_encode(["message" => "Invalid Endpoint"]);
    http_response_code(404);
}
?>
