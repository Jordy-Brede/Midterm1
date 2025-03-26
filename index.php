<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/Database.php';
require_once 'controllers/QuoteController.php';
require_once 'controllers/AuthorController.php';
require_once 'controllers/CategoryController.php';

$database = new Database();
$db = $database->connect();

$quoteController = new QuoteController($db);
$authorController = new AuthorController($db);
$categoryController = new CategoryController($db);
$request_method = $_SERVER["REQUEST_METHOD"];
$request_uri = $_SERVER["REQUEST_URI"];

switch ($request_uri) {
    case '/api/quotes/':
        if ($request_method == 'POST') {
            $quoteController->createQuote(); 
        } elseif ($request_method == 'PUT') {
            $quoteController->updateQuote(); 
        } elseif ($request_method == 'DELETE') {
            $quoteController->deleteQuote(); 
        }
        break;

    case '/api/authors/':
        if ($request_method == 'POST') {
            $authorController->createAuthor(); 
        } elseif ($request_method == 'PUT') {
            $authorController->updateAuthor(); 
        } elseif ($request_method == 'DELETE') {
            $authorController->deleteAuthor(); 
        }
        break;

    case '/api/categories/':
        if ($request_method == 'POST') {
            $categoryController->createCategory(); 
        } elseif ($request_method == 'PUT') {
            $categoryController->updateCategory(); 
        } elseif ($request_method == 'DELETE') {
            $categoryController->deleteCategory(); 
        }
        break;

    
        http_response_code(404);
        echo json_encode(["message" => "Route not found"]);
        break;
} 

?>
